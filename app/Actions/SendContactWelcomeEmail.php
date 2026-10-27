<?php

namespace App\Actions;

use App\EmailStatus;
use App\Mail\WelcomeEmail;
use App\Models\Contact;
use App\Models\EmailLog;
use Illuminate\Support\Facades\Mail;

class SendContactWelcomeEmail
{
    public function handle(Contact $contact): void
    {
        $emailLog = EmailLog::firstOrCreate(
            ['contact_id' => $contact->id],
            ['email_status' => EmailStatus::PENDING]
        );

        if ($emailLog->isSent()) {
            return;
        }

        Mail::to($contact->email)
            ->send(new WelcomeEmail($contact));

        $emailLog->update([
            'email_status' => EmailStatus::SENT,
            'sent_at' => now(),
        ]);
    }
}
