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
    return view('home');
});

Route::group(['prefix'=> 'DailyForms' , 'middleware'=>'auth'], function (){

    Route::get('SalesForm', 'App\Http\Controllers\DailyController@SalesForm')->name('SalesForm');
    Route::post('StoreSales', 'App\Http\Controllers\DailyController@StoreSales')->name('sales.store');


    Route::get('PlatformBalance', 'App\Http\Controllers\DailyController@PlatformsBalanceForms');
    Route::Post('StorePlatformBalance', 'App\Http\Controllers\DailyController@StorePlatformBalance')->name('PlatformBalance.store');


    Route::get('OutForm', 'App\Http\Controllers\DailyController@OutForm');
    Route::Post('StoreOuts', 'App\Http\Controllers\DailyController@StoreOuts')->name('Outs.store');


    Route::get('LendForm', 'App\Http\Controllers\DailyController@LendForm');
    Route::Post('StoreLend', 'App\Http\Controllers\DailyController@StoreLend')->name('Lends.store');


    Route::get('DealersBuyForm', 'App\Http\Controllers\DailyController@DealersBuyForm');
    Route::post('StoreDealersBuy', 'App\Http\Controllers\DailyController@StoreDealersBuy')->name('DealerBuy.store');

    Route::get('CustomersPaymentForm', 'App\Http\Controllers\DailyController@CustomersPaymentForm');
    Route::post('StoreCustomerPay', 'App\Http\Controllers\DailyController@StoreCustomerPay')->name('CustomerPay.store');

});


Route::group(['prefix'=> 'DataShow' , 'middleware'=>'auth'], function () {

    Route::get('SalesShow', 'App\Http\Controllers\DailyController@SalesShow')->name('sales.show');
    Route::post('SalesShow', 'App\Http\Controllers\DailyController@SalesShowWhithDates')->name('SalesShow.apply.dates');
    Route::get('SalesDelete/{id}', 'App\Http\Controllers\DailyController@SalesShowDelete')->name('Sales.Delete');
    Route::get('EditSales/{id}', 'App\Http\Controllers\DailyController@SalesEdit')->name('sales.edit');
    Route::post('SalesUpdate/{id}', 'App\Http\Controllers\DailyController@SalesUpdate')->name('Sales.Update');



    Route::get('CustomerPaymentsShow', 'App\Http\Controllers\DailyController@CustomerPaymentsShow')->name('CustomerPay.show');
    Route::post('CustomerPaymentsShow', 'App\Http\Controllers\DailyController@CustomerPaymentsShowWithDate')->name('CustomerPayWithDate.show');


    Route::get('LoansShow', 'App\Http\Controllers\DailyController@LoansShow')->name('Loans.show');
    Route::post('LoansShow', 'App\Http\Controllers\DailyController@LoansShowWithDate')->name('LoansShowWithDate.show');



    Route::get('OutsShow', 'App\Http\Controllers\DailyController@OutsShow')->name('Outs.show');
    Route::post('OutsShow', 'App\Http\Controllers\DailyController@OutsShowWithDate')->name('OutsShowWithDate.show');



    Route::get('PlatformBalanceShow', 'App\Http\Controllers\DailyController@PlatformBalanceShow')->name('PlatformBalance.show');
    Route::post('PlatformBalanceShow', 'App\Http\Controllers\DailyController@PlatformBalanceShowWithDate')->name('PlatformBalanceShowWithDate.show');


    Route::get('PurchasesShow', 'App\Http\Controllers\DailyController@PurchasesShow')->name('Purchases.show');
    Route::post('PurchasesShow', 'App\Http\Controllers\DailyController@PurchasesShowWithDate')->name('PurchasesWithDate.show');
});

