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

//Route::get('/', function () {
//    return view('welcome');
//});
//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

Route::get('/', function () {
    return redirect('admin/dashboard');
});

Route::get('login', 'LoginController@index')->name('login');
Route::post('login', 'LoginController@login')->name('login');
Route::post('logout', 'LoginController@logout')->name('logout');
Route::get('forget-password', 'LoginController@forgetPass')->name('forgetPass');
Route::post('recovery-password', 'LoginController@recoveryPassword')->name('recoveryPassword');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

    //User
    Route::get('myprofile', 'UserController@myprofile')->name('my.profile');
    Route::post('myprofile/edit', 'UserController@myprofileEdit')->name('my.profile.edit');


//User
    Route::get('user', 'UserController@index')->name('user.index');
    Route::post('user/view', 'UserController@view')->name('user.view');
    Route::get('user-filter', 'UserController@filter')->name('user.filter');
    Route::get('user/{id}/transaction', 'UserController@transaction')->name('user.transaction');
    Route::post('user/create', 'UserController@create')->name('user.create');
    Route::post('user/store', 'UserController@store')->name('user.store');
    Route::post('user/edit', 'UserController@edit')->name('user.edit');
    Route::post('user/update', 'UserController@update')->name('user.update');
    Route::delete('user/{id}/delete', 'UserController@destroy')->name('user.destroy');

    //User role
    Route::get('user-role', 'UserRoleController@index')->name('role.index');
    Route::get('user-role-filter', 'UserRoleController@filter')->name('role.filter');
    Route::post('user-role/create', 'UserRoleController@create')->name('role.create');
    Route::post('user-role/store', 'UserRoleController@store')->name('role.store');
    Route::post('user-role/edit', 'UserRoleController@edit')->name('role.edit');
    Route::post('user-role/update', 'UserRoleController@update')->name('role.update');
    Route::delete('user-role/{id}/delete', 'UserRoleController@destroy')->name('role.destroy');



    //Settings
    Route::get('setting', 'SettingController@index')->name('setting.index');
    Route::get('setting-filter', 'SettingController@filter')->name('setting.filter');
    Route::post('setting/create', 'SettingController@create')->name('setting.create');
    Route::post('setting/store', 'SettingController@store')->name('setting.store');
    Route::post('setting/edit', 'SettingController@edit')->name('setting.edit');
    Route::post('setting/update', 'SettingController@update')->name('setting.update');
    Route::delete('setting/{id}/delete', 'SettingController@destroy')->name('setting.destroy');


    //project Management
    Route::get('project', 'ProjectController@index')->name('project.index');
    Route::get('project-filter', 'ProjectController@projectFilter')->name('project.filter');
    Route::get('project/create', 'ProjectController@create')->name('project.create');
    Route::post('project/generateCusCode', 'ProjectController@generateCusCode')->name('generateCusCode.create');
    Route::post('project/store', 'ProjectController@store')->name('project.store');
    Route::get('project/{id}/view', 'ProjectController@view')->name('project.view');
    Route::get('project/{id}/edit', 'ProjectController@edit')->name('project.edit');
    Route::post('project/{id}/update', 'ProjectController@update')->name('project.update');
    Route::delete('project/{id}/delete', 'ProjectController@destroy')->name('project.destroy');
});

