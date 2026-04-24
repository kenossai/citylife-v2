<?php

namespace App\Services;

use App\Models\Member;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class ChurchSuiteService
{
    private string $apiUrl;
    private string $tokenUrl;
    private string $clientId;
    private string $clientSecret;

    public function __construct()
    {
        $this->apiUrl       = rtrim((string) config('services.churchsuite.api_url'), '/');
        $this->tokenUrl     = (string) config('services.churchsuite.token_url');
        $this->clientId     = (string) config('services.churchsuite.client_id');
        $this->clientSecret = (string) config('services.churchsuite.client_secret');
    }

    // -------------------------------------------------------------------------
    // Public API
    // -------------------------------------------------------------------------

    /**
     * Push a single member to ChurchSuite (create or update).
     * Updates the member's churchsuite_* fields in-place.
     *
     * @throws RuntimeException on HTTP or API error
     */
    public function syncMember(Member $member): void
    {
        $payload = $this->buildContactPayload($member);

        if ($member->churchsuite_id) {
            $response = $this->client()->put(
                "{$this->apiUrl}/addressbook/contacts/{$member->churchsuite_id}",
                $payload
            );
        } else {
            $response = $this->client()->post(
                "{$this->apiUrl}/addressbook/contacts",
                $payload
            );
        }

        if (! $response->successful()) {
            $error = $response->json('error.message') ?? $response->body();
            $member->update([
                'churchsuite_sync_status' => 'failed',
                'churchsuite_sync_error'  => $error,
            ]);
            throw new RuntimeException("ChurchSuite API error: {$error}");
        }

        $contactId = $response->json('id') ?? $response->json('data.id');

        $member->update([
            'churchsuite_id'          => $contactId,
            'churchsuite_synced_at'   => now(),
            'churchsuite_sync_status' => 'synced',
            'churchsuite_sync_error'  => null,
        ]);
    }

    /**
     * Check whether the service has been configured with credentials.
     */
    public function isConfigured(): bool
    {
        return filled($this->clientId) && filled($this->clientSecret);
    }

    // -------------------------------------------------------------------------
    // Internal helpers
    // -------------------------------------------------------------------------

    private function client(): PendingRequest
    {
        return Http::withToken($this->getAccessToken())
            ->acceptJson()
            ->asJson()
            ->timeout(15);
    }

    /**
     * Fetch (or reuse a cached) OAuth2 client-credentials access token.
     */
    private function getAccessToken(): string
    {
        return Cache::remember('churchsuite_access_token', 3300, function () {
            $response = Http::asForm()->post($this->tokenUrl, [
                'grant_type'    => 'client_credentials',
                'client_id'     => $this->clientId,
                'client_secret' => $this->clientSecret,
            ]);

            if (! $response->successful()) {
                throw new RuntimeException(
                    'ChurchSuite OAuth failed: ' . ($response->json('error_description') ?? $response->body())
                );
            }

            return $response->json('access_token');
        });
    }

    /**
     * Map a Member model to the ChurchSuite contact payload.
     */
    private function buildContactPayload(Member $member): array
    {
        $payload = [
            'first_name' => $member->first_name,
            'last_name'  => $member->last_name,
            'email'      => $member->email,
        ];

        if (filled($member->phone)) {
            $payload['mobile'] = $member->phone;
        }

        if ($member->date_of_birth) {
            $payload['date_of_birth'] = $member->date_of_birth->format('Y-m-d');
        }

        if (filled($member->gender)) {
            $payload['sex'] = match ($member->gender) {
                'male'   => 'M',
                'female' => 'F',
                default  => null,
            };
        }

        if (filled($member->marital_status)) {
            $payload['marital_status'] = $member->marital_status;
        }

        // Address — send as structured fields
        $address = [];
        if (filled($member->address))        { $address['address1'] = $member->address; }
        if (filled($member->address_line_2)) { $address['address2'] = $member->address_line_2; }
        if (filled($member->city))           { $address['city']     = $member->city; }
        if (filled($member->county))         { $address['county']   = $member->county; }
        if (filled($member->postcode))       { $address['postcode'] = $member->postcode; }
        if (filled($member->country))        { $address['country']  = $member->country; }

        if (! empty($address)) {
            $payload['address'] = $address;
        }

        // Communication preferences
        $payload['communication'] = [
            'general_email'          => $member->receive_general_email ? 1 : 0,
            'general_sms'            => $member->receive_general_sms   ? 1 : 0,
            'rota_reminders_email'   => $member->receive_rota_email     ? 1 : 0,
            'rota_reminders_sms'     => $member->receive_rota_sms       ? 1 : 0,
        ];

        return array_filter($payload, fn ($v) => $v !== null);
    }
}
