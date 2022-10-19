<?php


Route::group(['middleware' => ['auth']], function () {
    Route::get('/users', ['middleware' => ['permission:view users'],'uses'=>"PageController@manageUsers"])->name('manageUsers');
    Route::post('/users/add', ['middleware' => ['permission:add user'],'uses'=>"UserController@addUser"])->name('addUser');
    Route::get('/users/{id}/delete', ['middleware' => ['permission:modify users'],'uses'=>"UserController@deleteUser"])->name('deleteUser');
    Route::get('/users/{id}/role/{role}', ['middleware' => ['permission:define user roles'],'uses'=>"UserController@changeRole"])->name('changeRole');
    Route::post('/users/update', ['middleware' => ['permission:modify users'],'uses'=>"UserController@updateUser"])->name('updateUser');
    Route::post('/users/permissions/update', ['middleware' => ['permission:assign permissions'],'uses'=>"UserController@updatePermission"])->name('updatePermission');


    Route::get('/closures', ['middleware' => ['permission:edit system data'],'uses'=>"PageController@manageClosures"])->name('manageClosures');


    Route::post('/comment/add', ['middleware' => ['permission:make comment on article'],'uses'=>"CommentsController@addComment"])->name('addComment');

    //docuemnt viewer
    Route::get('/submission', ['middleware' => ['permission:view articles and pictures'],'uses'=>"PageController@allSubmissions"])->name('allSubmissions');
    Route::post('/submission/add', ['middleware' => ['permission:add article and pictures'],'uses'=>"SubmissionController@addSubmission"])->name('addSubmission');
    Route::get('/submission/of/{year}', ['middleware' => ['permission:view articles and pictures'],'uses'=>"PageController@allSubmissions"]);

    Route::get('/submission/selected', ['middleware' => ['permission:view selected articles'],'uses'=>"PageController@selectedSubmissions"])->name('selectedSubmissions');
    Route::get('/submission/selected/of/{year}', ['middleware' => ['permission:view selected articles'],'uses'=>"PageController@selectedSubmissions"]);

    Route::get('/submission/selected/of/{year}/download', ['middleware' => ['permission:download article'],'uses'=>"SubmissionController@downloadSelectedZip"])->name("downloadSelectedZip");

    Route::get('/submission/{submission_id}/view', ['middleware' => ['permission:view articles and pictures'],'uses'=>"PageController@submissionView"])->name('submissionView');

    Route::get('/submission/{submission}/select', ['middleware' => ['permission:select articles for publication'],'uses'=>"SubmissionController@selectForPublication"])->name('selectForPublication');
    Route::get('/submission/{submission}/unselect', ['middleware' => ['permission:select articles for publication'],'uses'=>"SubmissionController@unSelectForPublication"])->name('unSelectForPublication');

    Route::get('/document/load', ['middleware' => ['permission:view articles and pictures'],'uses'=>"ApiController@loadDocument"])->name('loadDocument');
    Route::get('/picture/{file}/load', ['middleware' => ['permission:view articles and pictures'],'uses'=>"ApiController@loadPicture"])->name('loadPicture');
    Route::get('/submission/{submission}/delete', ['middleware' => ['permission:modify articles and pictures'],'uses'=>"SubmissionController@deleteSubmission"])->name('deleteSubmission');

    Route::get("/faculty_students",['middleware' => ['permission:modify faculty'],'uses'=>"PageController@facultyStudents"])->name("facultyStudents");
    Route::get("/faculty/{faculty}/students/{user}/delete",['middleware' => ['permission:modify faculty'],'uses'=>"FacultyController@deleteStudent"])->name("deleteStudent");
    Route::get("/faculty/{faculty}/view",['middleware' => ['permission:view faculty details'],'uses'=>"PageController@facultyDetails"])->name("facultyDetails");
    Route::get("/faculty/{faculty}",['middleware' => ['permission:modify faculty'],'uses'=>"PageController@facultyDetails"]);
    Route::post("/faculty/students/add",['middleware' => ['permission:modify faculty'],'uses'=>"FacultyController@addStudent"])->name("addStudent");

    Route::get('/reports', ['middleware' => ['permission:view report'],'uses'=>'ApiController@homeReports'])->name('homeReports');
    Route::get('/faculty', ['middleware' => ['permission:view faculties'],'uses'=>'PageController@allFaculties'])->name('showFaculties');
    Route::post("/faculty/add",['middleware' => ['permission:add faculty'],'uses'=>"FacultyController@store"])->name("addFaculty");
    Route::get("/faculty/{faculty}/delete",['middleware' => ['permission:modify faculty'],'uses'=>"FacultyController@destroy"])->name("deleteFaculty");
    Route::post("/faculty/update",['middleware' => ['permission:modify faculty'],'uses'=>"FacultyController@update"])->name("updateFaculty");
    Route::get("/show/reports",['middleware' => ['permission:view report'],'uses'=>"PageController@reportView"])->name("reportView");

    Route::post("/closures/add",['middleware' => ['permission:modify faculty'],'uses'=>"ClosureController@addUpdateClosure"])->name("addUpdateClosure");


    Route::get('sendhtmlemail','PageController@submissionMailTest');

});

