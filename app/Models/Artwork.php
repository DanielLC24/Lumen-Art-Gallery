<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    protected $fillable = [
        'artist_id',
        'title',
        'slug',
        'category',
        'technique',
        'dimensions',
        'year',
        'availability',
        'price',
        'image_url',
        'source_url',
        'description',
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function priceAmount(): ?float
    {
        if (! preg_match('/[\d,.]+/', $this->price, $matches)) {
            return null;
        }

        return (float) str_replace(',', '', $matches[0]);
    }

    public function priceCurrency(): string
    {
        return str_contains(strtoupper($this->price), 'MXN') ? 'MXN' : 'USD';
    }

    public function isPurchasable(): bool
    {
        $availability = strtolower($this->availability);

        return $this->priceAmount() !== null
            && ! str_contains($availability, 'agotado')
            && ! str_contains($availability, 'no disponible')
            && ! str_contains($availability, 'referencia')
            && ! str_contains($availability, 'museografica');
    }
}
