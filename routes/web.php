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

    Route::post('campus/{id}/destination', 'rcpadmin\CampusController@destination_update');
    Route::get('campus/{id}/destination', 'rcpadmin\CampusController@destination');
    Route::post('campus/{id}/neighborhood', 'rcpadmin\CampusController@neighborhood_update');
    Route::get('campus/{id}/neighborhood', 'rcpadmin\CampusController@neighborhood');
    Route::post('campus/{id}/renting', 'rcpadmin\CampusController@renting_update');
    Route::get('campus/{id}/renting', 'rcpadmin\CampusController@renting');
    Route::get('campus/addNeighborhood', 'rcpadmin\CampusController@addNeighborhood');
    Route::get('campus/addDestination', 'rcpadmin\CampusController@addDestination');

    Route::resource('campus', 'rcpadmin\CampusController');

    Route::post('property/{id}/images-save', 'rcpadmin\PropertyController@store_images');
  //  Route::post('property/{id}/images', 'rcpadmin\PropertyController@images_update');
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
    Route::resource('careers', 'rcpadmin\CareerController');
    Route::resource('careerstype', 'rcpadmin\CareerTypeController');
    Route::resource('careerslider', 'rcpadmin\CareerSliderController');
    Route::resource('maps', 'rcpadmin\MapController');



});


Route::get('/articles', 'ArticlesController@index');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'UploadImagesController@create');
Route::post('/images-save', 'UploadImagesController@store');
Route::post('/images-delete', 'UploadImagesController@destroy');
Route::get('/images-show', 'UploadImagesController@index');