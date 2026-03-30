<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionAccessCode extends Model
{
    protected $fillable = [
        'email',
        'code',
        'speaker_slug',
        'verified',
        'expires_at',
    ];

    protected $casts = [
        'verified' => 'boolean',
        'expires_at' => 'datetime',
    ];
}
