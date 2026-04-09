<?php

namespace App\Models;

use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Activity
{
    protected $table = 'activity_log';

    protected $casts = [
        'properties'   => 'collection',
        'is_sensitive' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $activity) {
            $activity->properties = ($activity->properties ?? collect())->merge([
                'context' => [
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                    'url'        => request()->fullUrl(),
                    'method'     => request()->method(),
                ],
            ]);
        });
    }

    public function getSubjectLabelAttribute(): string
    {
        if (! $this->subject_type) {
            return '—';
        }

        $shortName = class_basename($this->subject_type);

        if ($this->subject) {
            $label = match (true) {
                method_exists($this->subject, 'getFilamentName') => $this->subject->getFilamentName(),
                isset($this->subject->name)                      => $this->subject->name,
                isset($this->subject->title)                     => $this->subject->title,
                isset($this->subject->full_name)                 => $this->subject->full_name,
                isset($this->subject->email)                     => $this->subject->email,
                default                                          => "#{$this->subject_id}",
            };

            return $label;
        }

        return "{$shortName} #{$this->subject_id} (deleted)";
    }

    public function getResourceTypeAttribute(): string
    {
        return $this->subject_type ? class_basename($this->subject_type) : '—';
    }

    public function getCauserLabelAttribute(): string
    {
        if (! $this->causer_type) {
            return 'System';
        }

        if ($this->causer) {
            return $this->causer->name ?? $this->causer->email ?? "#{$this->causer_id}";
        }

        return 'Deleted user #' . $this->causer_id;
    }

    public function getActionLabelAttribute(): string
    {
        return match ($this->event) {
            'created'    => 'Created',
            'updated'    => 'Updated',
            'deleted'    => 'Deleted',
            'logged_in'  => 'Logged In',
            'logged_out' => 'Logged Out',
            default      => ucfirst(str_replace('_', ' ', $this->event ?? 'logged')),
        };
    }
}
