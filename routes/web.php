<?php

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
//laraval created link
// Route::get('/', function () {
//     return view('welcome');
// });
//castome links
// Route::get('/contact', function (){
//     return view('contact');
// });


// Route::get('/about', function (){
//     return view('about');
// });

//FrontendController Route
Route::get('/', 'FrontendController@index');
Route::get('contact', 'FrontendController@contact');
Route::get('about', 'FrontendController@about');

// Auth::routes();
Auth::routes(['verify' => true]);

//HomeController Routes
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');




// CategoryController Routes
Route::get('/add/category', 'CategoryController@addcategory');
Route::post('/add/category/post', 'CategoryController@addcategorypost');
Route::get('/update/category/{category_id}', 'CategoryController@updatecategory');
Route::post('/update/category/post', 'CategoryController@updatecategorypost');
Route::get('/delete/category/{category_id}', 'CategoryController@deletecategory');
Route::get('/restore/category/{category_id}', 'CategoryController@restorecategory');
Route::get('/harddelete/category/{category_id}', 'CategoryController@harddeletecategory');

// ProfileController Routes
Route::get('/profile', 'ProfileController@index');
Route::Post('/profile/post', 'ProfileController@profilepost');
Route::Post('/password/post', 'ProfileController@passwordpost');
