<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepartmentMember extends Model
{
    protected $table = 'department_member';

    protected $fillable = [
        'department_id',
        'member_id',
        'role',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }
}
