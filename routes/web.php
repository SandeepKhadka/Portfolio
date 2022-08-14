<?php

use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/admin', function () {
//     return view('admin.index');
// });




Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'admin']], function (){
    Route::get('/',  [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');

    Route::resource('gallery',GalleryController::class);
    Route::resource('category',CategoryController::class);
    Route::resource('service',ServiceController::class);

    // Route::resource('gallery', BannerController::class);
    // Route::resource('category', CategoryController::class);
    // Route::resource('service', ProductController::class);
});

