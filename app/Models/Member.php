<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Member extends Authenticatable
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logExcept(['password', 'remember_token', 'password_setup_token'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->useLogName('members');
    }

    public function tapActivity(\Spatie\Activitylog\Models\Activity $activity, string $eventName): void
    {
        $activity->category     = 'Personal Information';
        $activity->severity     = match ($eventName) {
            'deleted' => 'high',
            default   => 'high',
        };
        $sensitiveFields = ['email', 'first_name', 'last_name', 'date_of_birth', 'phone', 'membership_status'];
        $changed = array_keys($activity->properties['attributes'] ?? []);
        $activity->is_sensitive = ! empty(array_intersect($changed, $sensitiveFields));
    }
    protected $guard = 'member';
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
        'avatar_path',
        'title',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'date_of_birth',
        'gender',
        'marital_status',
        'is_spouse_member',
        'spouse_id',
        'occupation',
        'address',
        'address_line_2',
        'city',
        'county',
        'postcode',
        'country',
        'receive_general_email',
        'receive_general_sms',
        'receive_rota_email',
        'receive_rota_sms',
        'data_protection_accepted',
        'data_protection_accepted_at',
        'membership_status',
        'first_visit_date',
        'membership_date',
        'baptism_status',
        'baptism_date',
        'notes',
        'bio',
        'is_active',
        'churchsuite_id',
        'churchsuite_synced_at',
        'churchsuite_sync_status',
        'churchsuite_sync_error',
        'notify_study_reminders',
        'notify_quiz_results',
        'notify_weekly_digest',
        'password_setup_token',
        'password_setup_token_expires_at',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'date_of_birth'    => 'date',
        'first_visit_date' => 'date',
        'membership_date'  => 'date',
        'baptism_date'     => 'date',
        'is_spouse_member'          => 'boolean',
        'is_active'                => 'boolean',
        'notify_study_reminders'   => 'boolean',
        'notify_quiz_results'      => 'boolean',
        'notify_weekly_digest'     => 'boolean',
        'receive_general_email'    => 'boolean',
        'receive_general_sms'      => 'boolean',
        'receive_rota_email'       => 'boolean',
        'receive_rota_sms'         => 'boolean',
        'data_protection_accepted' => 'boolean',
        'data_protection_accepted_at' => 'datetime',
        'password_setup_token_expires_at' => 'datetime',
        'churchsuite_synced_at'    => 'datetime',
    ];

    public function spouse(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'spouse_id');
    }

    public function getFullNameAttribute(): string
    {
        return trim(collect([$this->title, $this->first_name, $this->last_name])->filter()->implode(' '));
    }

    public function getAvatarUrlAttribute(): ?string
    {
        return $this->avatar_path ? asset('storage/' . $this->avatar_path) : null;
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('membership_status', $status);
    }

    /**
     * Generate a one-time password setup token (7-day expiry).
     * Returns the raw token so it can be embedded in an email link.
     */
    public function generatePasswordSetupToken(): string
    {
        $token = Str::random(64);

        $this->update([
            'password_setup_token'             => $token,
            'password_setup_token_expires_at'  => now()->addDays(7),
        ]);

        return $token;
    }

    /**
     * Generate a short-lived password reset token (1-hour expiry).
     * Reuses the same columns as the setup token.
     */
    public function generatePasswordResetToken(): string
    {
        $token = Str::random(64);

        $this->update([
            'password_setup_token'             => $token,
            'password_setup_token_expires_at'  => now()->addHour(),
        ]);

        return $token;
    }
}
