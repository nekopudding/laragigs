<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //all listings
    public function index() {
        return view('listings.index', [
            'heading' => 'Listings',
            //get all and sort by latest
            'listings' => Listing::latest()->filter(request(['tag']))->get(), 
        ]);
    }

    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing,
        ]);
    }
}
