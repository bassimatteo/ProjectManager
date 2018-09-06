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

use App\PunchInOut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/timesheet', function () {
    return view('timesheet');
});
  

Route::get('punchinouts', 'PunchInOutController@index');
Route::resource('punchinouts', 'PunchInOutController');


// Authorization routes (login, register, ...)
Auth::routes();

Route::middleware(['auth'])->group(function (){ 
   
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('home');
    
    
    Route::resource('comments', 'CommentsController');

    Route::resource('companies', 'CompaniesController');

    Route::resource('projects', 'ProjectsController');
    Route::get('/projects/create/{company_id?}', 'ProjectsController@create');
    Route::post('/projects/adduser', 'ProjectsController@addUser')->name('projects.adduser');
      
    
    Route::resource('roles', 'RolesController');

    Route::resource('tasks', 'TasksController');

    Route::resource('users', 'UsersController');
    Route::get('/users/{user_id?}/dashboard', 'UsersController@userDashboard');
     
    Route::resource('employees', 'EmployeesController');
    
    Route::get('api/punchinouts/{punch_in_out}', 'PunchInOutController@apiShow');
    Route::post('api/punchinouts/{punch_in_out}', 'PunchInOutController@apiUpdate');
    Route::delete('api/punchinouts/{punch_in_out}', 'PunchInOutController@apiDestroy');
    
    
});
