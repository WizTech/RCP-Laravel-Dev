<?php

namespace App\Http\Controllers\rcpadmin;

use App\rcpadmin\RentlinxListing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RentlinxListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = RentlinxListing::where('status', 'deny')->paginate(10);
        return view('rcpadmin/rentlinx-listing')->with('listings', $listings);
    }

    public function edit($id){
        $listing = RentlinxListing::find($id);
        return view('rcpadmin/rentlinx-listing/edit', compact('listing'));
    }

    public function approveRentListing($id){
        $listing = RentListing::find($id);
        return view('rcpadmin.rent-listing.edit', compact('listing'));
    }

    public function show($id)
    {
        $listing = RentListing::find($id);
        return view('rcpadmin.rent-listing.edit', compact('listing'));
    }


}
