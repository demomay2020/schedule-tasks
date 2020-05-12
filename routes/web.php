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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/event/display','EventController@display')->name('event.display');


//Route::auth();

//Route::get('/home', 'HomeController@index');

# Schedule routes

Route::get('/schedule/add','SchedulerController@add')->name('schedule.add');

Route::get('/schedule/step1/{booking_url}','SchedulerController@step1')->name('schedule.step1');

Route::get('/schedule/step2/{event}','SchedulerController@step2')->name('schedule.step2');

Route::get('/schedule/step3/{param1}','SchedulerController@step3')->name('schedule.step3');

Route::post('/schedule/create','SchedulerController@store')->name('schedule.create');

Route::get('/schedule/confirm','SchedulerController@confirm')->name('schedule.confirm');
        
Route::get('/schedule/display/{filter?}','SchedulerController@display')->name('schedule.display');

Route::get('/schedule/check/{date}','SchedulerController@check')->name('schedule.check');

# Event routes

Route::get('/event/add','EventController@add')->name('event.add');

Route::get('/event/edit/{event}','EventController@add')->name('event.edit');

Route::post('/event/create','EventController@store')->name('event.create');

Route::delete('/event/delete/{event}','EventController@destroy')->name('event.destroy');

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('password/reset',function() {
   return redirect()->route('public/index.php/password/reset');
});