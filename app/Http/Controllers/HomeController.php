<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $properties = Property::where('status', 'Active')
                             ->latest()
                             ->take(6)
                             ->get();

        // Get filter options for the search form
        $filterOptions = $this->getFilterOptions();

        return view('pages.home', [
            'properties' => $properties,
            'filterOptions' => $filterOptions,
            'agents' => [],
        ]);
    }

    /**
     * Display the about page.
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        // Fetch featured properties from database
        $featuredProperties = Property::where('is_featured', true)
            ->where('status', 'Active')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('pages.about', compact('featuredProperties'));
    }
    /**
     * Display the contact page.
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return view('pages.contact');
    }
    public function storeContact(ContactFormRequest $request)
    {
        try {
            // Send email
            Mail::to(env('CONTACT_EMAIL', 'admin@example.com'))
                ->send(new ContactFormMail($request->validated()));

            return redirect()->back()->with([
                'success' => 'Thank you for your message! We will get back to you soon.',
                'alert_type' => 'success'
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with([
                'error' => 'Sorry, there was an error sending your message. Please try again.',
                'alert_type' => 'error'
            ])->withInput();
        }
    }

    /**
     * Get filter options for search forms with null safety
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
            Log::error('Error getting filter options: ' . $e->getMessage());

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
            Log::error("Error getting distinct values for column '{$column}': " . $e->getMessage());
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
            Log::error("Error checking if column exists: " . $e->getMessage());
            return false;
        }
    }
}
