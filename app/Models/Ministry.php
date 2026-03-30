<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'subtitle',
        'description',
        'about_text',
        'vision_quote',
        'image_path',
        'gallery_images',
        'tags',
        'icon_svg_path',
        'icon_bg_class',
        'icon_text_class',
        'category_label',
        'category_color',
        'meeting_schedule',
        'location',
        'leader_name',
        'leader_role',
        'leader_image',
        'button_gradient',
        'link_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'      => 'boolean',
        'sort_order'     => 'integer',
        'gallery_images' => 'array',
        'tags'           => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
