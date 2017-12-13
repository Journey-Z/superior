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
    Route::get('', ['as' => 'home','uses'=>'HomeController@getHomePage']);
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
        return view('admin.home');
    });
    /** slide路由 */
    Route::get('/slides',['as' => 'slide_list','uses'=>'SlideController@getIndex']);
    Route::get('/create/slide',['as' => 'create_slide','uses'=>'SlideController@getCreate']);
    Route::post('/slide/upload',['as' => 'slide_upload','uses'=>'SlideController@upload']);
    Route::post('/slide/createOrUpdate',['as' => 'slide.createOrUpdate','uses'=>'SlideController@createOrUpdate']);

    /** 商品路由 */
    Route::get('/products',['as' => 'product_list','uses'=>'ProductController@getIndex']);
    Route::get('/create/product',['as' => 'create_product','uses'=>'ProductController@getCreate']);
    Route::post('/product/upload',['as' => 'product_upload','uses'=>'ProductController@upload']);
    Route::post('/product/createOrUpdate',['as' => 'product.createOrUpdate','uses'=>'ProductController@createOrUpdate']);
    Route::get('/test',['as' => 'test','uses'=>'ProductController@test']);
    Route::get('/product/batch_upload',['as' => 'batch_upload','uses'=>'ProductController@getBatch']);
    Route::post('/product/batch_upload',['as' => 'batch_upload','uses'=>'ProductController@batchUpload']);

    /** 分类路由 */
    Route::get('/categories',['as' => 'categories','uses'=>'CategoryController@getCategoryTree']);
    Route::get('/create/category',['as' => 'create_category','uses'=>'CategoryController@getCreate']);
    Route::post('/category/createOrUpdate',['as' => 'category.createOrUpdate','uses'=>'CategoryController@createOrUpdate']);
    Route::get('/category/choose_products',['as' => 'choose_products','uses'=>'CategoryController@chooseProducts']);
    Route::get('/category/chosen_products',['as' => 'chosen_products','uses'=>'CategoryController@chosenProducts']);
    Route::post('/category/add_products',['as' => 'category.add_products','uses'=>'CategoryController@addProducts']);
    Route::post('/category/delete_products',['as' => 'category.delete_products','uses'=>'CategoryController@deleteProducts']);

    /** 验证码路由 */
    Route::get('/captcha',['as' => 'captcha_list','uses'=>'CaptchaController@getIndex']);
    Route::get('/generate/captcha',['as' => 'generate_captcha','uses'=>'CaptchaController@getGenerate']);
    Route::post('/captcha/generate',['as' => 'captcha.generate','uses'=>'CaptchaController@generate']);

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
