<?php

namespace App\Jobs;

use App\Models\Member;
use App\Services\ChurchSuiteService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class SyncMemberToChurchSuite implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public int $backoff = 30;

    public function __construct(public readonly Member $member) {}

    public function handle(ChurchSuiteService $service): void
    {
        if (! $service->isConfigured()) {
            return;
        }

        $service->syncMember($this->member);
    }

    public function failed(Throwable $exception): void
    {
        $this->member->update([
            'churchsuite_sync_status' => 'failed',
            'churchsuite_sync_error'  => $exception->getMessage(),
        ]);
    }
}
