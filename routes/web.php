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

Auth::routes();
Route::get('/gallery/{id}/view', 'galleryController@view');
Route::get('/gallery/index', 'galleryController@index');
Route::get('/gallery/create', 'galleryController@create');
Route::get('/gallery/{id}/manage', 'galleryController@manage');
Route::get('/gallery/update', 'galleryController@update');
Route::post('/gallery/store', 'galleryController@store');

Route::get('/event/{id}/view', 'eventController@view');
Route::get('/event/index', 'eventController@index');
Route::get('/event/{id}/booked-users', 'eventController@usersBookedOnEvent');

Route::group(['middleware'=>'authenticated'], function(){
  Route::get('/advert/index', 'advertController@index');
  Route::get('/advert/{id}/edit', 'advertController@edit');
  Route::post('/advert/update', 'advertController@update');
  Route::get('/advert/create', 'advertController@create');
  Route::post('/advert/store', 'advertController@store');
  Route::get('/event/add-comment', 'eventController@addComment');
  Route::get('/event/book', 'eventController@book');
  Route::get('/event/my-events', 'eventController@myBookedEvents');
  Route::get('/event/my-events-history', 'eventController@myEventHistory');

});
Route::group(['middleware'=>'AdminAccessLevel1'], function(){

  Route::get('/home', function () {
      return view('home');
  });

  Route::get('/admin/create', 'AdminController@create');
  Route::post('/admin/store', 'AdminController@store');
  Route::get('/event/create', 'eventController@create');
  Route::post('/event/store', 'eventController@store');
  Route::get('/event/manage', 'eventController@manage');
  Route::get('/event/{id}/edit', 'eventController@edit');
  Route::post('/event/update', 'eventController@update');
});
