<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Http\Controllers\ListingController;

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

// // Without controller show all listings 
// Route::get('/', function () {
//     $listings = Listing::all();
//     return view('listings', compact('listings'));
// });

// // Route model binding:: automatically generate 404-page if object not found
// Route::get('/listing/{listing}', function(Listing $listing){
//     return view('listing', ['listing'=>$listing]);
// });

//test
Route::get('/test', function(){
    return view('test');
});


//test dependency injection


// class Car{
//     public $color;
//     public function start($color){
//         echo 'car started';
//         $this->color = $color;
//     }
// }

// Route::get('/dependency', function(Car $car){
//     $car->start('red');

//     dd($car->color);
// });

// With controller show all listings
Route::get('/', [ListingController::class, 'index']);

// show create listing form
Route::get('/listing/create', [ListingController::class, 'create']);

// with controller show single listing through route model binding
Route::get('/listing/{listing}', [ListingController::class, 'show']);

// store create form data
Route::post('/listing/store', [ListingController::class, 'store'])->name('listing.store');

// edit listing
Route::get('/listing/edit/{listing}', [ListingController::class, 'edit'])->name('listing.edit');

// update listing
Route::post('/listing/update/{listing}', [ListingController::class, 'update'])->name('listing.update');

// delete listing
Route::get('/listing/destroy/{listing}', [ListingController::class, 'destroy'])->name('listing.destroy');