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
    private string $accountId;

    public function __construct()
    {
        $this->apiUrl       = rtrim((string) config('services.churchsuite.api_url'), '/');
        $this->tokenUrl     = (string) config('services.churchsuite.token_url');
        $this->clientId     = (string) config('services.churchsuite.client_id');
        $this->clientSecret = (string) config('services.churchsuite.client_secret');
        $this->accountId    = (string) config('services.churchsuite.account_id');
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
            $response = $this->request(fn ($c) =>
                $c->put("{$this->apiUrl}/{$this->accountId}/addressbook/contacts/{$member->churchsuite_id}", $payload)
            );
        } else {
            // Search for an existing contact by email to prevent duplicates.
            $existingId = $this->findContactByEmail($member->email);

            if ($existingId) {
                $member->churchsuite_id = $existingId;
                $response = $this->request(fn ($c) =>
                    $c->put("{$this->apiUrl}/{$this->accountId}/addressbook/contacts/{$existingId}", $payload)
                );
            } else {
                $response = $this->request(fn ($c) =>
                    $c->post("{$this->apiUrl}/{$this->accountId}/addressbook/contacts", $payload)
                );
            }
        }

        if (! $response->successful()) {
            $error = $response->json('error.message') ?? $response->body();
            $member->update([
                'churchsuite_sync_status' => 'failed',
                'churchsuite_sync_error'  => $error,
            ]);
            throw new RuntimeException("ChurchSuite API error: {$error}");
        }

        $data = $response->json();

        $contactId = $data['id']
            ?? ($data['data']['id'] ?? null);

        if (! $contactId) {
            throw new RuntimeException('ChurchSuite did not return a contact ID');
        }

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
        return filled($this->clientId) && filled($this->clientSecret) && filled($this->accountId);
    }

    // -------------------------------------------------------------------------
    // Internal helpers
    // -------------------------------------------------------------------------

    private function client(): PendingRequest
    {
        return Http::withToken($this->getAccessToken())
            ->retry(3, 200)
            ->withUserAgent('CityLife/' . config('app.version', '1.0') . ' (Laravel; +' . config('app.url') . ')')
            ->acceptJson()
            ->asJson()
            ->timeout(15);
    }

    /**
     * Execute an HTTP callback, refreshing the token once on 401.
     */
    private function request(callable $callback): \Illuminate\Http\Client\Response
    {
        $response = $callback($this->client());

        if ($response->status() === 401) {
            Cache::forget('churchsuite_access_token');
            $response = $callback($this->client());
        }

        return $response;
    }

    /**
     * Search ChurchSuite for an existing contact by email.
     * Returns the contact ID string, or null if not found.
     */
    private function findContactByEmail(string $email): ?string
    {
        $response = $this->request(fn ($c) =>
            $c->get("{$this->apiUrl}/{$this->accountId}/addressbook/contacts", ['email' => $email])
        );

        if (! $response->successful()) {
            return null;
        }

        $data = $response->json();

        // ChurchSuite v2 returns paginated results: { data: [...] }
        $contacts = $data['data'] ?? $data;

        if (! is_array($contacts) || empty($contacts)) {
            return null;
        }

        return (string) ($contacts[0]['id'] ?? '')  ?: null;
    }

    /**
     * Fetch (or reuse a cached) OAuth2 client-credentials access token.
     */
    private function getAccessToken(): string
    {
        if (Cache::has('churchsuite_access_token')) {
            return Cache::get('churchsuite_access_token');
        }

        $response = Http::asForm()
            ->withBasicAuth($this->clientId, $this->clientSecret)
            ->withUserAgent('CityLife/' . config('app.version', '1.0') . ' (Laravel; +' . config('app.url') . ')')
            ->post($this->tokenUrl, [
                'grant_type' => 'client_credentials',
            ]);

        if (! $response->successful()) {
            throw new RuntimeException(
                'ChurchSuite OAuth failed: ' . ($response->json('error_description') ?? $response->body())
            );
        }

        $data = $response->json();

        $ttl = ($data['expires_in'] ?? 3600) - 60;

        Cache::put('churchsuite_access_token', $data['access_token'], $ttl);

        return $data['access_token'];
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

        return array_filter($payload, fn ($v) => $v !== null && $v !== []);
    }
}
