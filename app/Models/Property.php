<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
