<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Models\User;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;


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
    dd(request()->expectsJson());
})->middleware('auth');

Route::get('/user', function (User $user) {
    $user = $user->find(2);
    auth()->login($user);
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
Route::get('/listing/create', [ListingController::class, 'create'])->middleware('auth');

// manage listing
Route::get('/listing/manage', [ListingController::class, 'manage'])->middleware('auth');

// with controller show single listing through route model binding
Route::get('/listing/{listing}', [ListingController::class, 'show']);

// store create form data
Route::post('/listing/store', [ListingController::class, 'store'])->name('listing.store')->middleware('auth');

// edit listing
Route::get('/listing/edit/{listing}', [ListingController::class, 'edit'])->name('listing.edit')->middleware('auth');

// update listing
Route::post('/listing/update/{listing}', [ListingController::class, 'update'])->name('listing.update')->middleware('auth');

// delete listing
Route::get('/listing/destroy/{listing}', [ListingController::class, 'destroy'])->name('listing.destroy')->middleware('auth');




// show registration form
Route::get('/register', [UserController::class, 'register'])->middleware('guest');

// show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// create user
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

// logout user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// authenticate user
Route::post('/user/authenticate', [UserController::class, 'authenticate']);
