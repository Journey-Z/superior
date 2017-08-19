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


Route::group(['prefix' => ''], function () {
    Route::get('', function () {
        return view('website.index');
    });
    Route::get('/about',['as' => 'about',function () {
        return view('website.about');
    }]);
    Route::get('/strengths',['as' => 'about',function () {
        return view('website.strengths');
    }]);
    Route::get('/service-area',['as' => 'about',function () {
        return view('website.service-area');
    }]);
    Route::get('/customer',['as' => 'about',function () {
        return view('website.customer');
    }]);
    Route::get('/customer-detail',['as' => 'about',function () {
        return view('website.customer-detail');
    }]);
});
Route::get('/login',['uses'=>'AuthController@getLogin']);
Route::get('/logout',['as' => 'user_logout','uses'=>'AuthController@logout']);
Route::post('/login',['uses'=>'AuthController@postLogin']);

Route::group(['prefix' => 'admin','middleware' => ['web','auth']], function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::get('/slides',['as' => 'slide_list','uses'=>'SlideController@getIndex']);
    Route::get('/create/slide',['as' => 'create_slide','uses'=>'SlideController@getCreate']);
    Route::post('/slide/upload',['as' => 'slide_upload','uses'=>'SlideController@upload']);
    Route::post('/slide/createOrUpdate',['as' => 'slide.createOrUpdate','uses'=>'SlideController@createOrUpdate']);


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
