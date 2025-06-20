<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function destroyProperty($id)
    {
        $property = \App\Models\Property::findOrFail($id);

            // Delete all associated property images from disk and database
            if ($property->images && $property->images->count()) {
                foreach ($property->images as $img) {
                    if ($img->image && \File::exists(public_path('img/properties/' . $img->image))) {
                        \File::delete(public_path('img/properties/' . $img->image));
                    }
                    $img->delete();
                }
            }

            // Delete main image if i   t exists (legacy)
            if ($property->image && \File::exists(public_path('img/properties/' . $property->image))) {
                \File::delete(public_path('img/properties/' . $property->image));
            }

        $property->delete();

        // If AJAX, return JSON
        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        // Otherwise, redirect back with success message
        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully!');
    }
    public function adminDashboard()
    {
        $totalProperties = Property::count();
        $activeProperties = Property::where('status', 'Active')->count();
        $latestProperty = Property::latest()->first();

        return view('pages.admin.dashboard', compact('totalProperties', 'activeProperties', 'latestProperty'));
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'You have been logged out successfully.');
    }

    public function createProperty()
    {
        return view('pages.admin.create-property');
    }

    public function storeProperty(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            // 'address' => 'required|string|max:255',
            // 'city' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'property_type' => 'required|string|max:50',
            'building_type' => 'nullable|string|max:100',
            'status' => 'required|in:Active,Inactive',
            'is_featured' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            // 'area' => 'required|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle checkboxes
        $data['is_featured'] = $request->has('is_featured');
        $data['is_new'] = $request->has('is_new');
       $data = $request->except('images');
       $property = Property::create($data);

        if ($request->hasFile('images')) {
            foreach (array_slice($request->file('images'), 0, 15) as $image) {
                $imageName = uniqid('property_') . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('img/properties'), $imageName);
                $property->images()->create(['image' => $imageName]);
            }
        }

        return redirect()->route('properties.create')->with('success', 'Property created successfully!');
    }

    public function listProperties(Request $request)
    {
        $sort = $request->get('sort', 'created_at');
        $direction = $request->get('direction', 'desc');

        $sortable = ['title', 'price', 'status', 'created_at', 'city', 'bedrooms', 'bathrooms', 'area'];
        if (!in_array($sort, $sortable)) {
            $sort = 'created_at';
        }
        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        $properties = Property::orderBy($sort, $direction)->paginate(12);

        return view('pages.admin.list-properties', compact('properties', 'sort', 'direction'));
    }

    public function editProperty($id)
    {
        $property = \App\Models\Property::findOrFail($id);
        return view('pages.admin.edit-property', compact('property'));
    }

    public function updateProperty(Request $request, $id)
    {
        $property = \App\Models\Property::findOrFail($id);

        $validator = \Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'property_type' => 'required|string|max:50',
            'building_type' => 'nullable|string|max:100',
            'status' => 'required|in:Active,Inactive',
            'is_featured' => 'nullable|boolean',
            'is_new' => 'nullable|boolean',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'area' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();
        $data['is_featured'] = $request->has('is_featured');
        $data['is_new'] = $request->has('is_new');

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid('property_') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/properties'), $imageName);
            $data['image'] = $imageName;
        } else {
            unset($data['image']);
        }

        $property->update($data);

        return redirect()->route('properties.edit', $property->id)->with('success', 'Property updated successfully!');
    }
}
