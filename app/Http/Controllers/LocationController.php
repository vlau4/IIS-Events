<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
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
            'zip' => 'required|digits:5',
            'country' => 'required'
        ]);

        Location::create($formFields);

        return redirect('/')->with('message', 'Location created successfully!');
    }

    // Confirm New Location Created by User
    public function confirm(Location $location) {
        $formFields['confirmed'] = 1;

        $location->update($formFields);

        return redirect()->route('confirm')->with('mode', 2)->with('message', 'Location was confirmed successfully!');
    }

    // Unconfirm New Location Created by User
    public function unconfirm(Location $location) {
        $location->delete();
        return redirect()->route('confirm')->with('mode', 2)->with('message', 'Location was unconfirmed successfully!');
    }

    // Show Location Edit Form
    public function edit(Location $location) {
        return view('locations.edit', [
            'location' => $location
        ]);
    }

    // Update Location
    public function update(Request $request, Location $location) {
        
        $formFields = $request->validate([
            'street' => 'required',
            'number' => 'required',
            'city' => 'required',
            'zip' => 'required|digits:5',
            'country' => 'required'
        ]);

        $location->update($formFields);

        return redirect('/locations/manage')->with('message', 'Location was updated successfully!');
    }

    // Manage Locations
    public function manage() {
        return view('locations.manage', ['locations' => Location::where('confirmed', 1)->get()->sortBy('street')]);
    }
}
