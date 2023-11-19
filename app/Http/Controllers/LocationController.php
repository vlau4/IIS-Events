<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Show Locations
    public function show() {
        return view('locations.show', [
            'locations' => Location::latest()->paginate(6)
        ]);
    }

    // Show Create Form
    public function create() {
        return view('locations.create');
    }

    // Store Location Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'street' => 'required',
            'number' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'country' => 'required'
        ]);

        Location::create($formFields);

        return redirect('/')->with('message', 'Location created successfully!');
    }

    // Show Location Confirm Section
    public function showConfirm() {
        return view('roles.manager.confirmLocations', ['locations' => Location::where('confirmed', 0)->get()]);
    }

    // Confirm New Locations Created by Users
    public function confirm(Location $location) {
        $formFields['confirmed'] = 1;

        $location->update($formFields);

        return back()->with('message', 'Location confirmed successfully!');
    }
}
