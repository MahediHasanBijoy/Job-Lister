<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listing;

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

Route::get('/', function () {
    $listings = Listing::all();
    return view('listings', compact('listings'));
});

// Route model binding:: automatically generate 404-page if object not found
Route::get('/listing/{listing}', function(Listing $listing){
    return view('listing', ['listing'=>$listing]);
});

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

