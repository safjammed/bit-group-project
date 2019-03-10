<?php


Route::group(['middleware' => ['auth']], function () {
    Route::get('/users', ['middleware' => ['permission:view users'],'uses'=>"PageController@manageUsers"])->name('manageUsers');
    Route::post('/users/add', ['middleware' => ['permission:add users'],'uses'=>"UserController@addUser"])->name('addUser');
    Route::get('/users/{id}/delete', ['middleware' => ['permission:modify users'],'uses'=>"UserController@deleteUser"])->name('deleteUser');
    Route::get('/users/{id}/role/{role}', ['middleware' => ['permission:define user roles'],'uses'=>"UserController@changeRole"])->name('changeRole');
    Route::post('/users/update', ['middleware' => ['permission:modify users'],'uses'=>"UserController@updateUser"])->name('updateUser');
    Route::post('/users/permissions/update', ['middleware' => ['permission:assign permissions'],'uses'=>"UserController@updatePermission"])->name('updatePermission');



//    Route::get('/users', "PageController@manageUsers")->name('manageUsers');
//    Route::post('/users/add', "UserController@addUser")->name('addUser');
//    Route::get('/users/{id}/delete', "UserController@deleteUser")->name('deleteUser');
//    Route::get('/users/{id}/role/{role}', "UserController@changeRole")->name('changeRole');
//    Route::post('/users/update', "UserController@updateUser")->name('updateUser');
});

