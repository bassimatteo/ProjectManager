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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/timesheet', function () {
    return view('timesheet');
});
        
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function (){ 
    
    Route::resource('companies', 'CompaniesController');

    Route::resource('projects', 'ProjectsController');
    Route::get('/projects/create/{company_id?}', 'ProjectsController@create');
    Route::post('/projects/adduser', 'ProjectsController@addUser')->name('projects.adduser');
    
    Route::resource('roles', 'RolesController');

    Route::resource('tasks', 'TasksController');

    Route::resource('users', 'UsersController');
    
    Route::resource('comments', 'CommentsController');
    
});



