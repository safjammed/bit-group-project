<?php


Route::group(['middleware' => ['auth']], function () {
    Route::get('/users', ['middleware' => ['permission:view users'],'uses'=>"PageController@manageUsers"])->name('manageUsers');
    Route::post('/users/add', ['middleware' => ['permission:add users'],'uses'=>"UserController@addUser"])->name('addUser');
    Route::get('/users/{id}/delete', ['middleware' => ['permission:modify users'],'uses'=>"UserController@deleteUser"])->name('deleteUser');
    Route::get('/users/{id}/role/{role}', ['middleware' => ['permission:define user roles'],'uses'=>"UserController@changeRole"])->name('changeRole');
    Route::post('/users/update', ['middleware' => ['permission:modify users'],'uses'=>"UserController@updateUser"])->name('updateUser');
    Route::post('/users/permissions/update', ['middleware' => ['permission:assign permissions'],'uses'=>"UserController@updatePermission"])->name('updatePermission');


    Route::get('/closures', ['middleware' => ['permission:edit system data'],'uses'=>"PageController@manageClosures"])->name('manageClosures');


    Route::post('/comment/add', ['middleware' => ['permission:make comment on article'],'uses'=>"CommentsController@addComment"])->name('addComment');

    //docuemnt viewer
    Route::get('/submission', ['middleware' => ['permission:view articles and pictures'],'uses'=>"PageController@allSubmissions"])->name('allSubmissions');
    Route::get('/submission/{submission_id}/view', ['middleware' => ['permission:view articles and pictures'],'uses'=>"PageController@submissionView"])->name('submissionView');
    Route::get('/document/load', ['middleware' => ['permission:view articles and pictures'],'uses'=>"ApiController@loadDocument"])->name('loadDocument');
    Route::get('/picture/{file}/load', ['middleware' => ['permission:view articles and pictures'],'uses'=>"ApiController@loadPicture"])->name('loadPicture');
    Route::get('/submission/{submission}/delete', ['middleware' => ['permission:modify articles and pictures'],'uses'=>"SubmissionController@deleteSubmission"])->name('deleteSubmission');

    Route::get("/faculty_students",['middleware' => ['permission:modify faculty'],'uses'=>"PageController@facultyStudents"])->name("facultyStudents");
    Route::get("/faculty/{faculty}/students/{user}/delete",['middleware' => ['permission:modify faculty'],'uses'=>"FacultyController@deleteStudent"])->name("deleteStudent");
    Route::get("/faculty/{faculty}/view",['middleware' => ['permission:modify faculty'],'uses'=>"PageController@facultyDetails"])->name("facultyDetails");
    Route::post("/faculty/students/add",['middleware' => ['permission:modify faculty'],'uses'=>"FacultyController@addStudent"])->name("addStudent");

//    Route::get('/users', "PageController@manageUsers")->name('manageUsers');
//    Route::post('/users/add', "UserController@addUser")->name('addUser');
//    Route::get('/users/{id}/delete', "UserController@deleteUser")->name('deleteUser');
//    Route::get('/users/{id}/role/{role}', "UserController@changeRole")->name('changeRole');
//    Route::post('/users/update', "UserController@updateUser")->name('updateUser');
});

