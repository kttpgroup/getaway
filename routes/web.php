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
    return redirect()->route('members.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::group(['middleware' => 'auth'], function() {
Route::resource('members', 'MemberController');

Route::resource('cards', 'CardController');

Route::resource('types', 'TypeController');

Route::resource('reserves', 'ReserveController');


//Rental
Route::post('checkIn', ['as'=>'rent.checkIn', 'uses' => 'RentController@checkIn']);
Route::post('checkOut', ['as'=>'rent.checkOut', 'uses' => 'RentController@checkOut']);
Route::get('time', ['as' => 'rent.timeTable', 'uses' => 'RentController@show']);

//autucomplete && search
Route::get('autocomplete/{name}', ['as' => 'autocomplete', 'uses' => 'SearchController@autocomplete']);
Route::get('search', ['as' => 'search', 'uses' => 'SearchController@search']);

//edit by bee
Route::get('report', ['as' => 'reports.index', 'uses' => 'ReportController@index']);
Route::get('report/show', ['as' => 'reports.show', 'uses' => 'ReportController@show']);
Route::get('report/showCollect', ['as' => 'reports.collect', 'uses' => 'ReportController@showCollect']);
Route::post('exportReport', ['as'=>'reports.export', 'uses' => 'ReportController@exportReport']);
Route::post('calculatePrice', ['as'=>'rent.calculatePrice', 'uses' => 'RentController@calculatePrice']);
Route::post('report/collect/{from}/{end}', ['as'=>'report.reportCollect', 'uses' => 'ReportController@reportCollect']);
});