<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::get('/charts',['as' => 'charts',function () {
        return view('admin.charts');
    }]);

    Route::get('/tables',['as' => 'tables',function () {
        return view('admin.tables');
    }]);

    Route::get('/forms',['as' => 'forms',function () {
        return view('admin.forms');
    }]);

    Route::get('/bootstrap-elements',['as' => 'bootstrap-elements',function () {
        return view('admin.bootstrap-elements');
    }]);

    Route::get('/bootstrap-grid',['as' => 'bootstrap-grid',function () {
        return view('admin.bootstrap-grid');
    }]);

    Route::get('/blank-page',['as' => 'blank-page',function () {
        return view('admin.blank-page');
    }]);
});
