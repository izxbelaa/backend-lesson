<?php

namespace App\Models;

use App\EmailStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable('contact_id', 'email_status', 'sent_at')]
class EmailLog extends Model
{
    protected function casts(): array
    {
        return [
            'email_status' => EmailStatus::class,
            'sent_at' => 'datetime',
        ];
    }

    public function isSent(): bool
    {
        return $this->email_status === EmailStatus::SENT;
    }

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
