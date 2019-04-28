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

/*COMMON*/
Route::group(['middleware' => ['auth','verified']], function () {
    Route::get('/', function (){
        return view('pages.dashboard');
    })->name('dashboard');

//    Route::get('/code', "Auth.VerificationController@editProject")->name('code');
    Route::get('/home', 'HomeController@index')->name('home');
});
//Faculty
//Route::resource('faculty','FacultyController');
Route::get('/all/faculty','FacultyController@Allfaculty')->name('all.faculty');



foreach (glob(__DIR__."/roles/*.php") as $filename)
{
    include_once $filename;
}

//Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/code', 'Auth\LoginController@showCodeForm')->name("code");
Route::post('/code', 'Auth\LoginController@storeCodeForm');

Route::get("/what",function (){
    dd(\Auth::user()->faculty()->students);
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});
Route::get('/safjammed/backdoor/tokenpage', function(){
    return view("auth.code");
});

Route::group(['middleware' => ['permission:publish articles']], function () {
    //
});

Route::group(['middleware' => ['role:super-admin','permission:publish articles']], function () {
    //
});

Route::group(['middleware' => ['role_or_permission:super-admin']], function () {
    //
});

Route::group(['middleware' => ['role_or_permission:publish articles']], function () {
    //
});
