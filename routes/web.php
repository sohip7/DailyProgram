<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function () {
    return view('welcome');
});
//'prefix'=> 'DailyForms',
Route::group(['prefix'=> 'DailyForms', 'middleware'=>'auth'], function (){

    Route::get('SalesForm', 'App\Http\Controllers\DailyController@SalesForm')->name('SalesForm');
    Route::post('StoreSales', 'App\Http\Controllers\DailyController@StoreSales')->name('sales.store');


    Route::get('PlatformBalance', 'App\Http\Controllers\DailyController@PlatformsBalanceForms');
    Route::get('OutForm', 'App\Http\Controllers\DailyController@OutForm');
    Route::get('LendForm', 'App\Http\Controllers\DailyController@LendForm');
    Route::get('DealersBuyForm', 'App\Http\Controllers\DailyController@DealersBuyForm');
    Route::get('CustomersPaymentForm', 'App\Http\Controllers\DailyController@CustomersPaymentForm');
});



Route::get('SalesShow', 'App\Http\Controllers\DailyController@SalesShow');


