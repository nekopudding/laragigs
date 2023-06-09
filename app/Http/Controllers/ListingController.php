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

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/')->with('success', 'Listing created successfully!');
    }

    //update listing
    public function update(Listing $listing) {
        //check if user is authorized to update listing
        if(auth()->id() !== $listing->user_id) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = request()->validate([
            'title' => 'required',
            'company' => 'required', //unique in listings table, company column
            'location' => 'required',
            'website' => 'required',
            'email' => 'required|email', //email format validation
            'description' => 'required',
            'tags' => 'required',
        ]);

        if(request()->hasFile('logo')) {
            $formFields['logo'] = request()->file('logo')->store('logos','public');
        }

        $listing->update($formFields);

        return redirect('/listings/' . $listing->id)->with('success', 'Listing updated successfully!');
    }

    public function edit(Listing $listing) {
        return view('listings.edit', [
            'listing' => $listing,
        ]);
    }

    public function destroy(Listing $listing) {
        //check if user is authorized to delete listing
        if(auth()->id() !== $listing->user_id) {
            abort(403, 'Unauthorized Action');
        }
        
        $listing->delete();

        return redirect('/')->with('success', 'Listing deleted successfully!');
    }

    // Manage listings
    public function manage() {
        return view('listings.manage', [
            'listings' => Listing::where('user_id', auth()->id())->get(),
        ]);
    }
}
