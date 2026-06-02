<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryEvent extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'event_date',
        'location',
        'image_url',
        'description',
        'is_published',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_published' => 'boolean',
    ];
}
