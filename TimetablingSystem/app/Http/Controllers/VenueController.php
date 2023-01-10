<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;


class VenueController extends Controller
{
    public function index()
    { //fetch all records and display lists
        $data = Venue::get();
        //compact is to pass $data basically
        return view('/office-assistant/venue/venue-list', compact('data'));
    }

    public function addVenue()
    {
        return view('/office-assistant/venue/add-venue');
    }

    public function saveVenue(Request $request)
    {
//        Validation
        $request->validate([
            'venue_name' => 'required',
            'venue_level' => 'required|Integer',
            'venue_capacity' => 'required|Integer',
            'venue_location' => 'required'
        ]);

        $venue_name = $request->venue_name;
        $venue_level = $request->venue_level;
        $venue_capacity = $request->venue_capacity;
        $venue_location = $request->venue_location;

//        Create a model in our Eloquent Model Venue
        $venuedata = new Venue();
        $venuedata->venue_name = $venue_name;
        $venuedata->venue_level = $venue_level;
        $venuedata->venue_capacity = $venue_capacity;
        $venuedata->venue_location = $venue_location;
        $venuedata->save();

        return redirect()->back()->with('success', 'Successful: Venue has been created successfully');
    }

    public function editVenue($id)
    {
        $data = Venue::where('id', '=', $id)->first();
        return view('/office-assistant/venue/edit-venue', compact('data'));
    }

    public function updateVenue(Request $request)
    {
        //        Validation
        $request->validate([
            'venue_name' => 'required',
            'venue_level' => 'required|Integer',
            'venue_capacity' => 'required|Integer',
            'venue_location' => 'required'
        ]);


        $id = $request->id;
        $venue_name = $request->venue_name;
        $venue_level = $request->venue_level;
        $venue_capacity = $request->venue_capacity;
        $venue_location = $request->venue_location;

//        Create the update query by calling our Venue Eloquent Model
        Venue::where('id', '=', $id)->update([
            'venue_name' => $venue_name,
            'venue_level' => $venue_level,
            'venue_capacity' => $venue_capacity,
            'venue_location' => $venue_location
        ]);

        return redirect()->back()->with('success', 'Successful: Venue has been updated successfully');
    }

    public function deleteVenue($id)
    {
        Venue::where('id', '=', $id)->delete();
        return redirect()->back()->with('success', 'Successful: Venue has been deleted successfully');
    }
}
