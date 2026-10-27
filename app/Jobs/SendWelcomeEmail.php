<?php

namespace App\Jobs;

use App\Actions\SendContactWelcomeEmail;
use App\Models\Contact;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\Attributes\Backoff;
use Illuminate\Queue\Attributes\Tries;
use Illuminate\Support\Facades\Log;
use Throwable;

// 3 retries with 10 seconds backoff each
#[Tries(3)]
#[Backoff(10)]
class SendWelcomeEmail implements ShouldQueue
{
    use Queueable;

    // time out < retry after
    public int $timeout = 60;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Contact $contact
    ) {}

    /**
     * Execute the job.
     */
    public function handle(SendContactWelcomeEmail $action): void
    {
        $action->handle($this->contact);
    }

    /**
     * Handle a job failure.
     */
    public function failed(Throwable $exception): void
    {
        Log::error('Failed to send welcome email to contact ID: '.$this->contact->id, [
            'exception' => $exception,
        ]);
    }
}
