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

Route::get('/', 'AchiveCardsTableController@index')->name('home');
Route::post('/add_item', 'AchiveCardsTableController@addItem')->name('achiveCardsTable.addItem');
Route::get('/week_deals', 'WeekDealsController@index')->name('weekDeals.index');
Route::post('/add_card_to_task', 'WeekDealsController@addCardToTaskFromWeek')->name('weekDeals.addCardToTask');
Route::post('/add_task', 'WeekDealsController@addTaskDay')->name('weekDeals.addTaskDay');
