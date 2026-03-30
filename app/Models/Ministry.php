<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    protected $fillable = [
        'name',
        'subtitle',
        'description',
        'image_path',
        'icon_svg_path',
        'icon_bg_class',
        'icon_text_class',
        'category_label',
        'category_color',
        'meeting_schedule',
        'leader_name',
        'button_gradient',
        'link_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
