<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        Property::insert([
            [
                'title' => 'Luxury Modern Villa',
                'description' => 'A stunning contemporary villa featuring premium finishes, spacious living areas, and breathtaking city views in an exclusive neighborhood.',
                'address' => '1425 Beverly Hills Drive, Los Angeles, CA',
                'price' => 2450000.00,
                'bedrooms' => 5,
                'bathrooms' => 4,
                'area' => 4200,
                'image' => 'feature1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Elegant Townhouse',
                'description' => 'Experience sophisticated urban living in this beautifully designed townhouse with modern amenities and premium location access.',
                'address' => '856 Manhattan Boulevard, New York, NY',
                'price' => 1850000.00,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'area' => 3200,
                'image' => 'feature2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Contemporary Family Home',
                'description' => 'A perfect blend of comfort and style, this family home offers spacious rooms, modern kitchen, and beautifully landscaped garden.',
                'address' => '2847 Sunset Avenue, Miami, FL',
                'price' => 975000.00,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'area' => 2800,
                'image' => 'feature3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Spectacular Waterfront Villa',
                'description' => 'Indulge in luxury living with this magnificent waterfront villa featuring panoramic ocean views and private beach access.',
                'address' => '642 Oceanview Terrace, Malibu, CA',
                'price' => 3850000.00,
                'bedrooms' => 6,
                'bathrooms' => 5,
                'area' => 5500,
                'image' => 'feature4.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Charming Historic Townhouse',
                'description' => 'A beautifully restored historic townhouse combining classic architectural details with modern conveniences in a prime location.',
                'address' => '1923 Heritage Street, Boston, MA',
                'price' => 1650000.00,
                'bedrooms' => 3,
                'bathrooms' => 3,
                'area' => 2400,
                'image' => 'feature5.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Modern Downtown Penthouse',
                'description' => 'Live at the pinnacle of luxury in this stunning penthouse offering 360-degree city views and world-class amenities.',
                'address' => '777 Skyline Plaza, Chicago, IL',
                'price' => 2750000.00,
                'bedrooms' => 3,
                'bathrooms' => 4,
                'area' => 3800,
                'image' => 'feature6.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
