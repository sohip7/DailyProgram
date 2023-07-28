<?php

namespace App\Http\Controllers;

use App\Models\dailydata;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'user_name'=> $user_data->name
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

        return view('Show\SalesShow');
    }

}







