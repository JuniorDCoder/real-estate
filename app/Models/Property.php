<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    protected $fillable = [
        'title',
        'description',
        'address',
        'city',
        'price',
        'property_type',
        'building_type',
        'status',
        'is_featured',
        'is_new',
        'bedrooms',
        'bathrooms',
        'area',
        'image',
    ];
    protected $casts = [
        'price' => 'decimal:2',
        'area' => 'float',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
    ];

    // Accessor for formatted price
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price);
    }

    // Accessor for formatted area
    public function getFormattedAreaAttribute()
    {
        return number_format($this->area) . ' sq ft';
    }

    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/properties/' . $this->image) : asset('img/bg-img/default-property.jpg');
    }

    // Scope for active properties
    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    // Scope for featured properties
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Get core features (you can expand this based on your needs)
    public function getCoreFeatures()
    {
        $features = [];

        if ($this->is_new) {
            $features[] = 'New Construction';
        }

        if ($this->area > 2000) {
            $features[] = 'Spacious Layout';
        }

        if ($this->bedrooms >= 3) {
            $features[] = 'Multiple Bedrooms';
        }

        if ($this->bathrooms >= 2) {
            $features[] = 'Multiple Bathrooms';
        }

        // Add more dynamic features based on property attributes
        $defaultFeatures = [
            'Modern Architecture',
            'Premium Location',
            'Quality Construction',
            'Move-in Ready'
        ];

        return array_merge($features, array_slice($defaultFeatures, 0, 8 - count($features)));
    }

    public function images()
    {
        return $this->hasMany(\App\Models\PropertyImage::class);
    }
}
