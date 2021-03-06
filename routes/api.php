<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'v1', 'prefix' => 'v1'], function(){
    Route::post('/login','AuthController@login');

    Route::group(['middleware' => ['auth:api']], function(){
        Route::post('/logout','AuthController@logout');

        Route::group(['middleware' => ['isSuperAdmin']], function(){
            Route::resource('student', 'StudentController')->except(['create', 'edit']);
            Route::resource('faculty', 'FacultyController')->except(['create', 'edit']);
            Route::get('facultyStudents/{id}', 'FacultyController@getFacultyStudents');
        });
    });
});
