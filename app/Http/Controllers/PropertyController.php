<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query();

        // Apply filters if they exist
        $this->applyFilters($query, $request);

        $properties = $query->latest()->paginate(12);

        // Get filter options for the view
        $filterOptions = $this->getFilterOptions();

        return view('pages.properties.index', compact('properties', 'filterOptions'));
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);
        return view('pages.properties.show', compact('property'));
    }

    public function search(Request $request)
    {
        // Redirect to GET route with query parameters
        return redirect()->route('properties.search.results', $request->all());
    }

    public function searchResults(Request $request)
    {
        $query = Property::query();

        // Apply search filters
        $this->applyFilters($query, $request);

        $properties = $query->latest()->paginate(12)->appends($request->query());

        // Get filter options for the view
        $filterOptions = $this->getFilterOptions();

        // Get search parameters for display
        $searchParams = $request->all();

        return view('pages.properties.search-results', compact('properties', 'filterOptions', 'searchParams'));
    }

    private function applyFilters(Builder $query, Request $request)
    {
        // Keyword search
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'LIKE', "%{$keyword}%")
                  ->orWhere('description', 'LIKE', "%{$keyword}%")
                  ->orWhere('address', 'LIKE', "%{$keyword}%");
            });
        }

        // Location filter
        if ($request->filled('location') && $request->location !== 'All Locations') {
            $query->where('city', $request->location);
        }

        // Property type filter
        if ($request->filled('property_type') && $request->property_type !== 'Property Type') {
            $query->where('property_type', $request->property_type);
        }

        // Price range filter
        if ($request->filled('price_range') && $request->price_range !== 'Price Range') {
            $priceRanges = [
                'Under $100K' => [0, 100000],
                '$100K - $250K' => [100000, 250000],
                '$250K - $500K' => [250000, 500000],
                '$500K - $1M' => [500000, 1000000],
                'Above $1M' => [1000000, PHP_INT_MAX]
            ];

            if (isset($priceRanges[$request->price_range])) {
                $range = $priceRanges[$request->price_range];
                $query->whereBetween('price', $range);
            }
        }

        // Listing status filter
        if ($request->filled('listing_status') && $request->listing_status !== 'Listing Status') {
            $query->where('status', $request->listing_status);
        }

        // Bedrooms filter
        if ($request->filled('bedrooms') && $request->bedrooms !== 'Bedrooms') {
            if ($request->bedrooms === '5+') {
                $query->where('bedrooms', '>=', 5);
            } else {
                $query->where('bedrooms', $request->bedrooms);
            }
        }

        // Bathrooms filter
        if ($request->filled('bathrooms') && $request->bathrooms !== 'Bathrooms') {
            if ($request->bathrooms === '5+') {
                $query->where('bathrooms', '>=', 5);
            } else {
                $query->where('bathrooms', $request->bathrooms);
            }
        }

        // Square footage filter
        if ($request->filled('min_sqft')) {
            $query->where('square_footage', '>=', $request->min_sqft);
        }
        if ($request->filled('max_sqft')) {
            $query->where('square_footage', '<=', $request->max_sqft);
        }

        // Building type filter
        if ($request->filled('building_type') && $request->building_type !== 'Building Type') {
            $query->where('building_type', $request->building_type);
        }

        // Transaction type filter
        if ($request->filled('transaction_type') && $request->transaction_type !== 'Transaction Type') {
            $query->where('transaction_type', $request->transaction_type);
        }

        // Neighborhood filter
        if ($request->filled('neighborhood') && $request->neighborhood !== 'Neighborhoods') {
            $query->where('neighborhood', $request->neighborhood);
        }

        // Features filter (assuming features are stored as JSON or comma-separated)
        if ($request->filled('features')) {
            if (is_array($request->features)) {
                foreach ($request->features as $feature) {
                    $query->where('features', 'LIKE', "%{$feature}%");
                }
            }
        }
    }

    /**
     * Get filter options for search forms with comprehensive null safety
     */
    private function getFilterOptions()
    {
        try {
            return [
                'locations' => $this->getDistinctValues('city'),
                'property_types' => $this->getDistinctValues('property_type'),
                'building_types' => $this->getDistinctValues('building_type'),
                'neighborhoods' => $this->getDistinctValues('neighborhood'),
                'transaction_types' => $this->getDistinctValues('transaction_type'),
                'bedrooms_options' => $this->getDistinctValues('bedrooms'),
                'bathrooms_options' => $this->getDistinctValues('bathrooms'),
                'price_ranges' => [
                    'Under $100K',
                    '$100K - $250K',
                    '$250K - $500K',
                    '$500K - $1M',
                    'Above $1M'
                ],
                'listing_statuses' => ['Active', 'Pending', 'Sold', 'New Listing', 'Price Reduced'],
                'features' => [
                    'Swimming Pool',
                    'Garage',
                    'Garden',
                    'Fireplace',
                    'Basement',
                    'Gym/Fitness Center',
                    'Pet-Friendly',
                    'Balcony',
                    'Parking'
                ]
            ];
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error getting filter options in PropertyController: ' . $e->getMessage());

            // Return default empty values to prevent page crashes
            return [
                'locations' => collect(),
                'property_types' => collect(),
                'building_types' => collect(),
                'neighborhoods' => collect(),
                'transaction_types' => collect(),
                'bedrooms_options' => collect(),
                'bathrooms_options' => collect(),
                'price_ranges' => [
                    'Under $100K',
                    '$100K - $250K',
                    '$250K - $500K',
                    '$500K - $1M',
                    'Above $1M'
                ],
                'listing_statuses' => ['Active', 'Pending', 'Sold', 'New Listing', 'Price Reduced'],
                'features' => [
                    'Swimming Pool',
                    'Garage',
                    'Garden',
                    'Fireplace',
                    'Basement',
                    'Gym/Fitness Center',
                    'Pet-Friendly',
                    'Balcony',
                    'Parking'
                ]
            ];
        }
    }

    /**
     * Safely get distinct values from a column with null checks
     *
     * @param string $column
     * @return \Illuminate\Support\Collection
     */
    private function getDistinctValues($column)
    {
        try {
            // Check if the column exists in the properties table
            if (!$this->columnExists($column)) {
                Log::warning("Column '{$column}' does not exist in properties table");
                return collect();
            }

            return Property::whereNotNull($column)
                          ->where($column, '!=', '')
                          ->distinct()
                          ->pluck($column)
                          ->filter()
                          ->map(function ($value) {
                              return trim($value);
                          })
                          ->filter(function ($value) {
                              return !empty($value);
                          })
                          ->sort()
                          ->values();
        } catch (\Exception $e) {
            Log::error("Error getting distinct values for column '{$column}' in PropertyController: " . $e->getMessage());
            return collect();
        }
    }

    /**
     * Check if a column exists in the properties table
     *
     * @param string $column
     * @return bool
     */
    private function columnExists($column)
    {
        try {
            $columns = \Illuminate\Support\Facades\Schema::getColumnListing('properties');
            return in_array($column, $columns);
        } catch (\Exception $e) {
            Log::error("Error checking if column exists in PropertyController: " . $e->getMessage());
            return false;
        }
    }


}
