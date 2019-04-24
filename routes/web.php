<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

Route::middleware(['auth', 'admin_modules'])->prefix('rcpadmin')->group(function () {
    Route::get('/', 'rcpadmin\DashboardController@index');
    Route::post('admin_users/{id}/modules', 'rcpadmin\AdminUsers@modules_update');
    Route::get('admin_users/{id}/modules', 'rcpadmin\AdminUsers@modules');
    Route::resource('admin_users', 'rcpadmin\AdminUsers');
    Route::resource('users', 'rcpadmin\UsersController');
    Route::post('campus/{id}/map', 'rcpadmin\CampusController@map_update');
    Route::get('campus/{id}/map', 'rcpadmin\CampusController@map');

    Route::post('campus/{id}/apartment', 'rcpadmin\CampusController@apartment_update');
    Route::get('campus/{id}/apartment', 'rcpadmin\CampusController@apartment');

    Route::post('campus/{id}/destination', 'rcpadmin\CampusController@destination_update');
    Route::get('campus/{id}/destination', 'rcpadmin\CampusController@destination');
    Route::post('campus/{id}/neighborhood', 'rcpadmin\CampusController@neighborhood_update');
    Route::get('campus/{id}/neighborhood', 'rcpadmin\CampusController@neighborhood');
    Route::post('campus/{id}/renting', 'rcpadmin\CampusController@renting_update');
    Route::get('campus/{id}/renting', 'rcpadmin\CampusController@renting');
    Route::get('campus/addNeighborhood', 'rcpadmin\CampusController@addNeighborhood');
    Route::get('campus/addDestination', 'rcpadmin\CampusController@addDestination');

    Route::resource('campus', 'rcpadmin\CampusController');

    Route::post('property/images-delete', 'rcpadmin\PropertyController@destroy_images');
    Route::get('property/{id}/delete', 'rcpadmin\PropertyController@delete_images');
    Route::post('property/{id}/images-save', 'rcpadmin\PropertyController@store_images');
    Route::get('property/{id}/images', 'rcpadmin\PropertyController@images');

    Route::post('property/{id}/feature', 'rcpadmin\PropertyController@feature_update');
    Route::get('property/{id}/feature', 'rcpadmin\PropertyController@feature');

    Route::post('property/{id}/floorplan', 'rcpadmin\PropertyController@floorplan_update');

    Route::get('property/{id}/floorplan', 'rcpadmin\PropertyController@floorplan');
    Route::get('property/addFloorplan', 'rcpadmin\PropertyController@addFloorplan');
    Route::resource('property', 'rcpadmin\PropertyController');
    Route::resource('entrata', 'rcpadmin\EntrataController');
    Route::resource('yardi', 'rcpadmin\YardiController');
    Route::resource('category', 'rcpadmin\CategoryController');
    Route::resource('price', 'rcpadmin\PriceController');
    Route::resource('block_email', 'rcpadmin\BlockEmailController');
    Route::resource('block_ip', 'rcpadmin\BlockIPController');
    Route::resource('unsubcribers', 'rcpadmin\UnsubscriberController');
    Route::resource('feature', 'rcpadmin\FeatureController');
    Route::resource('template', 'rcpadmin\TemplateController');
    Route::resource('testimonials', 'rcpadmin\TestimonialController');
    Route::resource('news', 'rcpadmin\NewsController');
    Route::resource('career', 'rcpadmin\CareerController');
    Route::resource('careertype', 'rcpadmin\CareerTypeController');
    Route::resource('careerslider', 'rcpadmin\CareerSliderController');
    Route::resource('campus-insight', 'rcpadmin\CampusInsightController');

    Route::resource('expired-property', 'rcpadmin\ExpiredPropertyController');
    Route::resource('team-member', 'rcpadmin\TeamController');
    Route::resource('unapproved', 'rcpadmin\UnapprovedController');
    Route::resource('unapproved', 'rcpadmin\UnapprovedController');
    Route::resource('premium-landlord', 'rcpadmin\PreimumLandlordController');
    Route::resource('premium-listings', 'rcpadmin\PreimumListingsController');

    Route::post('simple-keyword-text', 'rcpadmin\SimpleTextKeywordController@store');
    Route::resource('simple-keyword-text', 'rcpadmin\SimpleTextKeywordController');

    Route::resource('resources', 'rcpadmin\ResourceController');

    Route::get('create-resource/{id}', 'rcpadmin\ResourceController@createResource');

    Route::get('show-resource/{id}', 'rcpadmin\ResourceController@showResource');

    Route::delete('delete-resource/{id}', 'rcpadmin\ResourceController@deleteResource');

    Route::get('app-users', 'rcpadmin\AppUserController@index');
    Route::post('app-users', 'rcpadmin\AppUserController@index');
    Route::get('app-leads', 'rcpadmin\AppLeadController@index');
    Route::post('app-leads', 'rcpadmin\AppLeadController@index');
    Route::get('app-favorites', 'rcpadmin\AppFavoriteController@index');
    Route::get('visits', 'rcpadmin\AppViewController@index');
    Route::post('visits', 'rcpadmin\AppViewController@index');
    Route::get('screen-visits', 'rcpadmin\ScreenVisitController@index');
    Route::get('time-on-app', 'rcpadmin\TimeOnAppController@index');
    Route::get('bounce-rate', 'rcpadmin\BounceRateController@index');
    Route::get('csv-export', 'rcpadmin\AppViewController@csvExport');
    Route::get('screen-export', 'rcpadmin\ScreenVisitController@screenExport');
    Route::get('favorite-export', 'rcpadmin\AppFavoriteController@favroiteExport');
    Route::get('lead-export', 'rcpadmin\AppLeadController@leadExport');
    Route::get('visit-export', 'rcpadmin\AppViewController@visitExport');

    Route::resource('unapproved', 'rcpadmin\UnapprovedController');
    Route::resource('land-loard', 'rcpadmin\LandloardController');

    Route::get('rentlinx-listing', 'rcpadmin\RentlinxListingController@index');
    Route::get('rentlinx-listing-edit/{id}', 'rcpadmin\RentlinxListingController@edit');


    Route::get('approve-rentlisting/{id}', 'rcpadmin\RentListingController@approveRentListing');
    Route::put('rentlinx-listing', 'rcpadmin\RentlinxListingController@updateRentListing');

});


Route::get('/articles', 'ArticlesController@index');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');