<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftAidDeclaration extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'postcode',
        'phone',
        'email',
        'gift_aid_code',
        'declaration_date',
        'confirmed',
    ];

    protected $casts = [
        'declaration_date' => 'date',
        'confirmed' => 'boolean',
    ];
}
