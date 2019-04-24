<?php

namespace App\Http\Controllers\rcpadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\rcpadmin\RentlinxListing;
use App\User;
use App\CategoryModel;
use App\CampusModel;
use App\Property;
use Illuminate\Support\Facades\DB;


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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($rentlinx_id)
    {
        $listing['rentlinx'] = RentlinxListing::where('rentlinx_id', $rentlinx_id)->first()->toArray();
        $listing['landlord'] = User::where('role_id', 3)->get();
        $listing['campus'] = CampusModel::all();
        $listing['category'] = CategoryModel::all();
        return view('rcpadmin/rentlinx-listing/edit', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $rentlinx_id = $_POST['rentlinx_id'];
        $rentID = Property::where('rentlinx_listing_id', $rentlinx_id)->first();

        if (isset($rentID)) {
            DB::table('property')
                ->where('rentlinx_listing_id', $request->rentlinx_id)
                ->update([
                    'campus_id' => $request->campus_id,
                    'category_id' => $request->category_id,
                    'landlord_id' => $request->landlord_id,
                    'title' => $request->listing_title,
                    'address' => $request->address,
                    'description' => $request->description,
                    'email' => $request->contact_email,
                    'phone' => $request->contact_phone,
                    'property_expiry_date' => $request->property_expiry,
                    'rentlinx_listing_id' => $request->rentlinx_id
                ]);
        } else {
            $newProp = DB::table('property')->insert([
                'campus_id' => $request->campus_id,
                'category_id' => $request->category_id,
                'landlord_id' => $request->landlord_id,
                'title' => $request->listing_title,
                'address' => $request->address,
                'description' => $request->description,
                'email' => $request->contact_email,
                'phone' => $request->contact_phone,
                'property_expiry_date' => $request->property_expiry,
                'rentlinx_listing_id' => $request->rentlinx_id
            ]);
        }
        return redirect('rcpadmin/rentlinx-listing');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($rentlinx_id)
    {
        $data = RentlinxListing::where('rentlinx_id', $rentlinx_id)->first();
        DB::table('rentlinx_listings')
            ->where('rentlinx_id', $rentlinx_id)
            ->update(['status' => 'deny']);
        return redirect('rcpadmin/rentlinx-listing');
    }

}
