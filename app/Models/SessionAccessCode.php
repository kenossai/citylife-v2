<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionAccessCode extends Model
{
    protected $fillable = [
        'email',
        'code',
        'speaker_slug',
        'year',
        'verified',
        'expires_at',
        'last_used_at',
    ];

    protected $casts = [
        'year'         => 'integer',
        'verified'     => 'boolean',
        'expires_at'   => 'datetime',
        'last_used_at' => 'datetime',
    ];
}
