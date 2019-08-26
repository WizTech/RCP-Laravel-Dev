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

Route::middleware(['auth:web', 'admin_modules'])->prefix('rcpadmin')->group(function () {
    Route::get('/', 'rcpadmin\DashboardController@index');
    Route::get('export-activities', 'rcpadmin\AdminUsers@activityExport');
    Route::post('admin_users/{id}/modules', 'rcpadmin\AdminUsers@modules_update');
    Route::get('admin_users/{id}/modules', 'rcpadmin\AdminUsers@modules');

    Route::get('admin_users/edit_admin/{id}', 'rcpadmin\AdminUsers@edit_admin');
    Route::patch('admin_users/update_admin/{id}', 'rcpadmin\AdminUsers@update_admin');

    Route::post('admin-users/change-password', 'rcpadmin\AdminUsers@updatePassword');
    Route::get('admin-users/change-password', 'rcpadmin\AdminUsers@changePassword');

    Route::resource('admin_users', 'rcpadmin\AdminUsers');
    Route::get('users/{id}/login', 'rcpadmin\UsersController@login');
    Route::get('users/{id}/tracker', 'rcpadmin\UsersController@tracker');
    Route::post('users/{id}/delete', 'rcpadmin\UsersController@delete');
    Route::post('users/{id}/restoreUser', 'rcpadmin\UsersController@restoreUser');
    Route::get('user-search-ajax', 'rcpadmin\UsersController@search_ajax');
    Route::post('user-search-ajax', 'rcpadmin\UsersController@search_ajax');
    Route::get('user-search', 'rcpadmin\UsersController@search');
    Route::post('user-search', 'rcpadmin\UsersController@search');
    Route::get('users/trash', 'rcpadmin\UsersController@trash');

    Route::get('users/edit_user/{id}', 'rcpadmin\UsersController@edit_user');
    Route::patch('users/update_user/{id}', 'rcpadmin\UsersController@update_user');

    Route::resource('users', 'rcpadmin\UsersController');

    Route::post('campus/saveZipcode', 'rcpadmin\CampusController@saveZipcode');
    Route::post('campus/saveAbbr', 'rcpadmin\CampusController@saveAbbr');
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


    Route::post('campus-search-ajax', 'rcpadmin\CampusController@search_ajax');
    Route::post('campus-search', 'rcpadmin\CampusController@search');

    Route::get('campus/edit_campus/{id}', 'rcpadmin\CampusController@edit_campus');
    Route::patch('campus/update_campus/{id}', 'rcpadmin\CampusController@update_campus');

    Route::resource('campus', 'rcpadmin\CampusController');

    Route::post('property/images-delete', 'rcpadmin\PropertyController@destroy_images');
    Route::get('property/{id}/delete', 'rcpadmin\PropertyController@delete_images');
    Route::post('property/{id}/images-save', 'rcpadmin\PropertyController@store_images');
    Route::get('property/{id}/images', 'rcpadmin\PropertyController@images');
    Route::get('property/{id}/landlords', 'rcpadmin\PropertyController@landlord_listing');
    Route::get('property/{id}/listing', 'rcpadmin\PropertyController@listing');
    Route::post('property/{id}/feature', 'rcpadmin\PropertyController@feature_update');
    Route::get('property/{id}/feature', 'rcpadmin\PropertyController@feature');

    Route::post('property/{id}/floorplan', 'rcpadmin\PropertyController@floorplan_update');

    Route::get('property/{id}/floorplan', 'rcpadmin\PropertyController@floorplan');
    Route::get('property/addFloorplan', 'rcpadmin\PropertyController@addFloorplan');

    Route::post('property-search-ajax', 'rcpadmin\PropertyController@search_ajax');
    Route::post('property-search', 'rcpadmin\PropertyController@search');
    Route::resource('property', 'rcpadmin\PropertyController');
    Route::get('entrata/edit-property/{id}', 'rcpadmin\EntrataController@editProperty');
    Route::put('entrata/update-property/{id}', 'rcpadmin\EntrataController@updateProperty');
    Route::get('entrata/edit-campus/{id}', 'rcpadmin\EntrataController@editCampus');
    Route::put('entrata/update-campus/{id}', 'rcpadmin\EntrataController@updateCampus');
    Route::resource('entrata', 'rcpadmin\EntrataController');
    Route::resource('yardi', 'rcpadmin\YardiController');
    Route::resource('category', 'rcpadmin\CategoryController');
    Route::resource('price', 'rcpadmin\PriceController');
    Route::resource('block_email', 'rcpadmin\BlockEmailController');
    Route::resource('block_ip', 'rcpadmin\BlockIPController');
    Route::resource('unsubcribers', 'rcpadmin\UnsubscriberController');
    Route::get('feature/{id}', 'rcpadmin\FeatureController@type');
    Route::resource('feature', 'rcpadmin\FeatureController');
    Route::resource('template', 'rcpadmin\TemplateController');
    Route::resource('testimonials', 'rcpadmin\TestimonialController');
    Route::resource('pages', 'rcpadmin\PagesController');
    Route::resource('news', 'rcpadmin\NewsController');
    Route::post('landing-page/{id}/edit', 'rcpadmin\LandingPageController@update');
    Route::resource('landing-page', 'rcpadmin\LandingPageController');
    Route::resource('career', 'rcpadmin\CareerController');
    Route::resource('careertype', 'rcpadmin\CareerTypeController');
    Route::resource('careerslider', 'rcpadmin\CareerSliderController');
    Route::resource('campus-insight', 'rcpadmin\CampusInsightController');
    Route::get('expired-listing-report', 'rcpadmin\ExpiredPropertyController@leadExport');
    Route::resource('expired-property', 'rcpadmin\ExpiredPropertyController');
    Route::resource('team-member', 'rcpadmin\TeamController');
    Route::post('premium-landlord/{id}/web', 'rcpadmin\PreimumLandlordController@web_update');
    Route::get('premium-landlord/{id}/web', 'rcpadmin\PreimumLandlordController@web');
    Route::resource('premium-landlord', 'rcpadmin\PreimumLandlordController');
    Route::resource('premium-listings', 'rcpadmin\PreimumListingsController');

    Route::post('simple-keyword-text', 'rcpadmin\SimpleTextKeywordController@store');
    Route::resource('simple-keyword-text', 'rcpadmin\SimpleTextKeywordController');

    Route::resource('resources', 'rcpadmin\ResourceController');
    Route::get('list-contact-export', 'rcpadmin\ListContactFormController@leadExport');
    Route::resource('list-contact-form', 'rcpadmin\ListContactFormController');
    Route::resource('meta-details', 'rcpadmin\MetaDetailsController');

    Route::resource('resources', 'rcpadmin\ResourceController');

    Route::get('create-resource/{id}', 'rcpadmin\ResourceController@createResource');

    Route::get('show-resource/{id}', 'rcpadmin\ResourceController@showResource');

    Route::delete('delete-resource/{id}', 'rcpadmin\ResourceController@deleteResource');

    // Route::resource('sublease-track', 'rcpadmin\SubleaseTrackController');


    /*Stats*/
    Route::post('all-leads-export', 'rcpadmin\EmailTrackController@export_leads');
    Route::post('email-leads-export', 'rcpadmin\EmailTrackController@export_list');
    Route::post('email-leads-modal', 'rcpadmin\EmailTrackController@exportList');
    Route::get('email-leads', 'rcpadmin\EmailTrackController@index');

    Route::get('phone-leads', 'rcpadmin\PhoneLeadsController@index');
    Route::post('landlord-site-leads', 'rcpadmin\LandlordSiteLeadsController@index');
    Route::get('landlord-site-leads', 'rcpadmin\LandlordSiteLeadsController@index');
    Route::get('landlord-total-leads', 'rcpadmin\LandlordTotalLeadsController@index');
    Route::get('active-properties', 'rcpadmin\ActivePropertiesController@index');
    Route::post('active-properites-export', 'rcpadmin\ActivePropertiesController@exportList');
    Route::get('export-landlord-active-properties', 'rcpadmin\LandlordActivePropertiesController@index');

    Route::post('properties-count', 'rcpadmin\PropertiesCountController@export');
    Route::get('properties-count', 'rcpadmin\PropertiesCountController@index');

    Route::post('users-count', 'rcpadmin\UsersCountController@export');
    Route::get('users-count', 'rcpadmin\UsersCountController@index');
    Route::get('student-views', 'rcpadmin\StudentViewController@index');
    Route::get('sublease-track', 'rcpadmin\SubleaseTrackController@index');
    Route::get('top-spots/{id}', 'rcpadmin\TopsSpotsController@campus');
    Route::get('top-spots', 'rcpadmin\TopsSpotsController@index');
    Route::post('imitation-email', 'rcpadmin\ImitationEmailController@export_list');
    Route::get('imitation-email', 'rcpadmin\ImitationEmailController@index');
    Route::get('expiring-property', 'rcpadmin\ExpiringPropertyController@index');

    Route::get('leads-per-company/{id}/edit', 'rcpadmin\LeadsPerCompanyController@edit');
    Route::post('company-leads-export', 'rcpadmin\LeadsPerCompanyController@export_list');
    Route::get('leads-per-company', 'rcpadmin\LeadsPerCompanyController@index');
    Route::post('property-feeds-export', 'rcpadmin\PropertyFeedsController@export_list');
    Route::get('property-feeds', 'rcpadmin\PropertyFeedsController@index');

    /*Stats*/

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

    Route::get('rentlinx-listing/edit-property/{id}', 'rcpadmin\RentlinxListingController@editProperty');
    Route::put('rentlinx-listing/update-property/{id}', 'rcpadmin\RentlinxListingController@updateProperty');
    Route::get('rentlinx-listing/edit-campus/{id}', 'rcpadmin\RentlinxListingController@editCampus');
    Route::put('rentlinx-listing/update-campus/{id}', 'rcpadmin\RentlinxListingController@updateCampus');
    Route::resource('rentlinx-listing', 'rcpadmin\RentlinxListingController');
    Route::resource('unapproved', 'rcpadmin\UnapprovedController');
    Route::resource('user-fee', 'rcpadmin\UserFeeController');

});
Route::middleware(['auth:student'])->prefix('student')->group(function () {
    Route::get('/', 'StudentController@index');
    Route::post('student', 'StudentController@update');
});

Route::post('student/change-password', 'StudentController@updatePassword');
Route::post('student/add-sublease', 'StudentController@saveSublease');
Route::post('student', 'StudentController@update');
Route::get('/articles', 'ArticlesController@index');

Route::get('/articles', 'ArticlesController@index');


Route::get('/', function () {
    return redirect(route('login'));
});
Auth::routes();
/*Landlord Portal Routes*/
Route::get('landlord', 'LandlordController@index');
Route::get('landlord/listing', 'LandlordController@listing');
Route::get('landlord/deleted-listing', 'LandlordController@deleted_listing');
Route::post('landlord', 'LandlordController@update')->name('listing.update');
Route::post('landlord/property', 'LandlordController@store')->name('listing.store');
Route::post('landlord/change-password', 'LandlordController@updatePassword');
Route::get('landlord/change-password', 'LandlordController@changePassword');
Route::get('landlord/property/addFloorplan', 'LandlordController@addFloorplan');
Route::post('landlord/active-listing', 'LandlordController@activeProperty');
Route::post('landlord/property/{id}', 'LandlordController@updateProperty');
Route::get('landlord/property/{id}', 'LandlordController@show');
Route::post('landlord/property/{id}/floorplan', 'LandlordController@floorplan_update')->name('floorplan.update');
Route::get('landlord/property/{id}/floorplan', 'LandlordController@floorplan');
Route::post('landlord/property/{id}/feature', 'LandlordController@feature_update')->name('feature.update');
Route::get('landlord/property/{id}/feature', 'LandlordController@feature');
Route::post('landlord/property/images-delete', 'LandlordController@destroy_images');
Route::get('landlord/property/{id}/delete', 'LandlordController@delete_images');
Route::post('landlord/property/{id}/images-save', 'LandlordController@store_images');
Route::get('landlord/property/{id}/images', 'LandlordController@images');
Route::get('landlord/add-property', 'LandlordController@create');
Route::get('landlord/campus-insight', 'LandlordController@campusInsight');
Route::post('landlord/tracker/{id}', 'LandlordController@tracker');
Route::post('landlord/tracker', 'LandlordController@tracker');
Route::get('landlord/tracker/{id}', 'LandlordController@tracker');
Route::get('landlord/tracker', 'LandlordController@tracker');
Route::post('landlord/ajax', 'LandlordController@ajax');
Route::post('landlord/ajax_count_show', 'LandlordController@ajax_count_show');
Route::post('landlord/ajax_leads', 'LandlordController@ajax_leads');
Route::post('landlord/ajax_count_show_lead', 'LandlordController@ajax_count_show_lead');
/*Landlord Portal Routes*/


Route::get('student/application', 'StudentController@application');
Route::get('student/change-password', 'StudentController@changePassword');
Route::get('student', 'StudentController@index');
Route::post('student/{id}/edit', 'StudentController@updateSublease');
Route::get('student/{id}/edit', 'StudentController@show');
Route::get('student/add-sublease', 'StudentController@addSublease');
Route::get('student/edit-sublease', 'StudentController@editSublease');
Route::get('studentLogout', 'Auth\LoginController@studentLogout');


Route::post('login/student', 'Auth\LoginController@studentLogin');
Route::post('/login/landlord', 'Auth\LoginController@landlordLogin');
Route::post('/register/student', 'Auth\RegisterController@createStudent');
Route::post('/register/landlord', 'Auth\RegisterController@createLandlord');


Route::get('/login/student', 'Auth\LoginController@showStudentLoginForm');
Route::get('/login/landlord', 'Auth\LoginController@showLandlordLoginForm');
Route::get('/register/student', 'Auth\RegisterController@showStudentRegisterForm');
Route::get('/register/landlord', 'Auth\RegisterController@showLandlordRegisterForm');
//Route::view('/landlord', 'landlord');
Route::get('/home', 'HomeController@index')->name('home');