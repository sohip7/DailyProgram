<?php

namespace App\Http\Controllers;

use App\Models\CustomerPay;
use App\Models\dailydata;
use App\Models\DealersBuy;
use App\Models\lenddata;
use App\Models\Outs;
use App\Models\PlatformBalance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;

class DailyController extends Controller
{
    //
    public function SalesForm()
    {
        $user_data = Auth::user();
        return view('Forms\SalesForm',compact('user_data'));
    }


    public function StoreSales(Request $request){
        $user_data = Auth::user();

        $sales = dailydata::create([
            'item'=> $request->item_name,
            'amount'=> $request->amount,
            'quantity'=> $request->quantity,
            'notes'=> $request->notes,
            'total'=> $request->amount * $request->quantity ,
            'user_name'=> $user_data->name
        ]);
        return redirect()->back()->with(['success'=> 'تم الحفظ بنجاح']);
    }

    public function SalesShowDelete(Request $request){

        $Sales2 = dailydata::find($request -> id);   // $Sales::where('id','') -> first();

        if (!$Sales2){
            return redirect()->back()->with(['error' => ('لم يتم إيجاد الصف في قاعدة البيانات')]);
        }else {

            $Sales2->delete();

            return redirect()->back()->with(['success' => 'تم حذف البيان بنجاح ']);
        }
    }



    public function SalesEdit(Request  $request)
    {
        $user_data = Auth::user();
        $Sales = dailydata::find($request -> id);  // search in given table id only
        if (!$Sales)
            return redirect()->back()->with(['success' => 'لم يتم إيجاد الصنف في قاعدة بياناتنا ']);

        $Sales = dailydata::select('id','item', 'amount', 'quantity', 'notes')->find($request -> id);

        return view('Edit_Forms.SalesEdit', compact('Sales','user_data'));

    }

    public  function SalesUpdate(Request $request){
        $user_data = Auth::user();
        $sales = dailydata::find($request -> id);
        if (!$sales)
            return redirect()->back()->with(['success' => 'لم يتم إيجاد الصنف في قاعدة بياناتنا ']);


        //update data
        $sales->update([
            'item'=> $request->item_name,
            'amount'=> $request->amount,
            'quantity'=> $request->quantity,
            'notes'=> $request->notes,
            'total'=> $request->amount * $request->quantity ,
            'user_name'=> $user_data->name
        ]);

        return redirect()->route('sales.show')->with(['success' => 'تم التحديث بنجاح']);

    }





    public function StoreDealersBuy(Request $request){
        $user_data = Auth::user();

        $sales = DealersBuy::create([
            'item'=> $request->item_name,
            'amount'=> $request->amount,
            'SellerName'=> $request->DealerName,
            'notes'=> $request->notes,
            'UserName'=> $user_data->name
        ]);
        return redirect()->back()->with(['success'=> 'تم الحفظ بنجاح']);
    }

    public function StoreOuts(Request $request){
        $user_data = Auth::user();

        $sales = Outs::create([
            'item'=> $request->item_name,
            'amount'=> $request->amount,
            'notes'=> $request->notes,
            'userName'=> $user_data->name
        ]);
        return redirect()->back()->with(['success'=> 'تم الحفظ بنجاح']);
    }

    public function StoreLend(Request $request){
        $user_data = Auth::user();

        $sales = lenddata::create([
            'item'=> $request->item_name,
            'amount'=> $request->amount,
            'quantity'=> $request->quantity,
            'debtorName'=> $request->debtor_name,
            'notes'=> $request->notes,
            'total'=> $request->amount * $request->quantity ,
            'UserName'=> $user_data->name
        ]);
        return redirect()->back()->with(['success'=> 'تم الحفظ بنجاح']);
    }


    public function StoreCustomerPay(Request $request){
        $user_data = Auth::user();

        $sales = CustomerPay::create([
            'CustomerName'=> $request->CustomerName,
            'amount'=> $request->amount,
            'notes'=> $request->notes,
            'userName'=> $user_data->name
        ]);
        return redirect()->back()->with(['success'=> 'تم الحفظ بنجاح']);
    }

    public function StorePlatformBalance(Request $request){
        $user_data = Auth::user();

        $sales = PlatformBalance::create([
            'OoredooBalance'=> $request->OoredooBalance,
            'JawwalBalance'=> $request->JawwalBalance,
            'JawwalPayBalance'=> $request->JawwalPayBalance,
            'ElectricityBalance'=> $request->ElectricityBalance,
            'OoredooBillsBalance'=> $request->OoredooBillsBalance,
            'BalanceType'=> $request->BalanceType,
            'notes'=> $request->notes,
            'userName'=> $user_data->name
        ]);
        return redirect()->back()->with(['success'=> 'تم الحفظ بنجاح']);
    }

    public function PlatformsBalanceForms(){
        $user_data = Auth::user();

        return view('Forms\PlatformsBalanceForms',compact('user_data'));
    }

    public function OutForm(){
        $user_data = Auth::user();
        return view('Forms\OutForm',compact('user_data'));
    }

    public function LendForm(){
        $user_data = Auth::user();
        return view('Forms\LendForm',compact('user_data'));
    }

    public function DealersBuyForm(){
        $user_data = Auth::user();
        return view('Forms\DealersBuyForm',compact('user_data'));
    }

    public function CustomersPaymentForm(){
        $user_data = Auth::user();
        return view('Forms\CustomersPaymentForm',compact('user_data'));
    }

    public function SalesShow(){

        $sales=dailydata::whereDate('created_at',today() )->get();
        $todayTotal=dailydata::whereDate('created_at', today())->sum('total');
        $date=today()->format('Y-m-d');



        return view('Show\SalesShow',compact('sales','todayTotal','date'));
    }

    public function SalesShowWhithDates(Request $request){

        $date = $request->input('date');


        if ($date) {
            $sales = dailydata::whereDate('created_at', $date)
                ->get();

            $todayTotal = dailydata::whereDate('created_at', $date)->sum('total');

            return view('Show\SalesShow', compact('sales', 'todayTotal','date'));
        } else {

            return route('sales.show');
        }
    }

    public function PurchasesShow(){

        $Purchases=DealersBuy::whereDate('created_at',today() )->get();
        $todayTotal = $Purchases->sum('amount');
        $date=today()->format('Y-m-d');
        return view('Show\PurchasesShow',compact('Purchases','date','todayTotal'));
    }
    public function PurchasesShowWithDate(Request $request){

        $date = $request->input('date');
        $todayTotal = DealersBuy::whereDate('created_at', $date)->sum('amount');


        if ($date) {
            $Purchases = DealersBuy::whereDate('created_at', $date)
                ->get();

            return view('Show\PurchasesShow', compact('Purchases','date','todayTotal'));
        } else {

            return route('Purchases.show');
        }
    }
    public function CustomerPaymentsShow(){

        $CusPays=CustomerPay::whereDate('created_at',today() )->get();
        $todayTotal=CustomerPay::whereDate('created_at', today())->sum('amount');
        $date=today()->format('Y-m-d');



        return view('Show\CustomerPaymentsShow',compact('CusPays','todayTotal','date'));
    }
    public function CustomerPaymentsShowWithDate(Request $request){

        $date = $request->input('date');
        $todayTotal = CustomerPay::whereDate('created_at', $date)->sum('amount');


        if ($date) {
            $CusPays= CustomerPay::whereDate('created_at', $date)
                ->get();

            return view('Show\CustomerPaymentsShow', compact('CusPays','date','todayTotal'));
        } else {

            return route('CustomerPay.show');
        }
    }

    public function LoansShow(){

        $Loans=lenddata::whereDate('created_at',today() )->get();
        $todayTotal=lenddata::whereDate('created_at', today())->sum('total');
        $date=today()->format('Y-m-d');



        return view('Show\LoansShow',compact('Loans','todayTotal','date'));
    }
    public function LoansShowWithDate(Request $request){

        $date = $request->input('date');
        $todayTotal = lenddata::whereDate('created_at', $date)->sum('total');


        if ($date) {
            $Loans= lenddata::whereDate('created_at', $date)
                ->get();

            return view('Show\LoansShow', compact('Loans','date','todayTotal'));
        } else {

            return route('Loans.show');
        }
    }

    public function OutsShow(){

        $Outs=Outs::whereDate('created_at',today() )->get();
        $todayTotal=Outs::whereDate('created_at', today())->sum('amount');
        $date=today()->format('Y-m-d');



        return view('Show\OutsShow',compact('Outs','todayTotal','date'));
    }
    public function OutsShowWithDate(Request $request){

        $date = $request->input('date');
        $todayTotal = lenddata::whereDate('created_at', $date)->sum('total');


        if ($date) {
            $Outs= lenddata::whereDate('created_at', $date)
                ->get();

            return view('Show\OutsShow', compact('Outs','date','todayTotal'));
        } else {

            return route('Outs.show');
        }
    }

    public function PlatformBalanceShow(){

        $PlatsBalance=PlatformBalance::whereDate('created_at',today() )->get();
        $date=today()->format('Y-m-d');

        $todayOpenBal=PlatformBalance::whereDate('created_at',today() )->where('BalanceType','افتتاحي')->first();
        $todayCloseBal=PlatformBalance::whereDate('created_at',today() )->where('BalanceType','نهائي')->first();
        $msgg="مدخلش اللوب";
        $OoredooBalanceEnd="";
        if(!$todayOpenBal){
            $msgg="انت لم تدخل الرصيد النهائي لهذا اليوم";
        } elseif (!$todayOpenBal){

            $msgg="انت لم تدخل الرصيد الافتتاحي لهذا اليوم";

        }else {
           $OoredooBalanceEnd=$todayCloseBal->OoredooBalance-$todayOpenBal->OoredooBalance;
          $JawwalBalanceEnd=$todayCloseBal->JawwalBalance-$todayOpenBal->JawwalBalance;
           $JawwalPayBalanceEnd=$todayCloseBal->JawwalPayBalance-$todayOpenBal->JawwalPayBalance;
           $ElectricityBalanceEnd=$todayCloseBal->ElectricityBalance-$todayOpenBal->ElectricityBalance;
           $OoredooBillsBalanceEnd=$todayCloseBal->OoredooBillsBalance-$todayOpenBal->OoredooBillsBalance;


        }

        return view('Show\PlatformBalanceShow',
            compact('PlatsBalance','date','OoredooBalanceEnd',
            'JawwalBalanceEnd','JawwalPayBalanceEnd','ElectricityBalanceEnd',
                'OoredooBillsBalanceEnd'));
    }





//    public function PlatformBalanceShowWithDate(Request $request){
//
//        $date = $request->input('date');
//
//
//        if ($date) {
//            $Outs= PlatformBalance::whereDate('created_at', $date)
//                ->get();
//
//            return view('Show\OutsShow', compact('Outs','date','todayTotal'));
//        } else {
//
//            return route('Outs.show');
//        }
//    }





}









