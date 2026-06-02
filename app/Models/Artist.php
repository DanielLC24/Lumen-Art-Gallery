<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'specialty',
        'photo_url',
        'bio',
        'featured_works',
    ];

    public function artworks()
    {
        return $this->hasMany(Artwork::class);
    }
}
