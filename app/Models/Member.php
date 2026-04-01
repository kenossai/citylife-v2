<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    protected static function booted(): void
    {
        static::creating(function (Member $member) {
            $member->membership_number = static::generateMembershipNumber();
        });
    }

    public static function generateMembershipNumber(): string
    {
        $prefix = 'CL' . date('Y');
        $latest = static::where('membership_number', 'like', $prefix . '%')
            ->orderByDesc('membership_number')
            ->value('membership_number');

        $nextNumber = $latest
            ? (int) substr($latest, strlen($prefix)) + 1
            : 1001;

        return $prefix . $nextNumber;
    }

    protected $fillable = [
        'membership_number',
        'title',
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'marital_status',
        'is_spouse_member',
        'spouse_id',
        'occupation',
        'address',
        'city',
        'postcode',
        'country',
        'membership_status',
        'first_visit_date',
        'membership_date',
        'baptism_status',
        'baptism_date',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'date_of_birth'    => 'date',
        'first_visit_date' => 'date',
        'membership_date'  => 'date',
        'baptism_date'     => 'date',
        'is_spouse_member' => 'boolean',
        'is_active'        => 'boolean',
    ];

    public function spouse(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'spouse_id');
    }

    public function getFullNameAttribute(): string
    {
        return trim(collect([$this->title, $this->first_name, $this->last_name])->filter()->implode(' '));
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('membership_status', $status);
    }
}
