<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Matter extends Model
{
    /** @use HasFactory<\Database\Factories\MatterFactory> */
    use HasFactory;


    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
