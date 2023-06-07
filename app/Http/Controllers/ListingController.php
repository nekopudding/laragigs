<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //show all listings
    public function index() {
        return view('listings.index', [
            'heading' => 'Listings',
            //get all and sort by latest
            'listings' => Listing::latest()->filter(request(['tag','search']))
            ->paginate(6), 
        ]);
    }

    //show single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing,
        ]);
    }

    //show form to create new listing
    public function create() {
        return view('listings.create');
    }

    //store new listing
    public function store() {
        $formFields = request()->validate([
            'title' => 'required',
            'company' => 'required|unique:listings,company', //unique in listings table, company column
            'location' => 'required',
            'website' => 'required',
            'email' => 'required|email', //email format validation
            'description' => 'required',
            'tags' => 'required',
        ]);

        if(request()->hasFile('logo')) {
            $formFields['logo'] = request()->file('logo')->store('logos','public');
        }

        Listing::create($formFields);

        return redirect('/')->with('success', 'Listing created successfully!');
    }
}
