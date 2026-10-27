<?php

namespace App\Actions;

use App\Jobs\SendWelcomeEmail;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class CreateContact
{
    public function handle(array $data): Contact
    {
        return DB::transaction(function () use ($data) {
            $contact = Contact::create($data);
            // Dispatch the job to send the welcome email
            SendWelcomeEmail::dispatch($contact)->afterCommit();

            return $contact;

        });

    }
}
