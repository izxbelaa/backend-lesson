<?php

namespace App\Models;

use Database\Factories\ContactsFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable('first_name', 'last_name', 'email')]
class Contact extends Model
{
    /** @use HasFactory<ContactsFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function matters(): HasMany
    {
        return $this->hasMany(Matter::class);
    }
}
