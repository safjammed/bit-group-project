<?php
Route::group(['middleware' => ['role:super-admin','auth']], function () {
    Route::get('/dashboard', function (){
        return view('pages.dashboard');
    })->name('photographerDashboard');
});

