<?php

namespace App\Http\Controllers;

use App\Models\balance_sale;
use App\Models\CustomerPay;
use App\Models\dailydata;
use App\Models\DealersBuy;
use App\Models\lenddata;
use App\Models\note;
use App\Models\Outs;
use App\Models\PlatformBalance;
use App\Models\User;
use Carbon\Carbon;
use Dompdf\Dompdf;
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

    public function enterDailyNotes()
    {
        $user_data = Auth::user();
        return view('Forms\enterNotes',compact('user_data'));
    }


    public function balance_sales_show()
    {
       $date=today()->format('Y-m-d');
       $balancsales=balance_sale::whereDate('created_at',$date)->get();
        return view('Show\balanceSalesShow',get_defined_vars());
    }

    public function balanceSalesShowWithDate(Request $request)
    {
       $date=$request->date;
       $balancsales=balance_sale::whereDate('created_at',$date)->get();
        return view('Show\balanceSalesShow',get_defined_vars());
    }
    public function DailyNotesWithDate(Request $request)
    {
       $date=$request->date;
       $note=note::whereDate('created_at',$date)->get();
        return view('DailyNotesShow',get_defined_vars());
    }

    /************************************ Sales *****************************/
    public function StoreSales(Request $request){
        $user_data = Auth::user();

        $sales = dailydata::create([
            'item'=> $request->item_name,
            'RecordType'=> $request->RecordType,
            'amount'=> $request->amount,
            'quantity'=> $request->quantity,
            'FirstPay'=> $request->FirstPay,
            'notes'=> $request->notes,
            'total'=> $request->amount * $request->quantity ,
            'user_name'=> $user_data->name
        ]);
        if ($request->has('RecordType')) {
            $selectedValue = $request->input('RecordType');

            // تنفيذ العمليات المطلوبة بناءً على القيمة المختارة
            if($selectedValue === 'Ooredoo') {
               $ooredooSale=balance_sale::select('ooredoo')->whereDate('created_at', today())->first();
               $x=$ooredooSale->ooredoo;
                $x+=$request->amount;
                $ooredooSale=balance_sale::whereDate('created_at', today())->update([
                    'ooredoo'=>$x
                    ]);

            } elseif ($selectedValue === 'Jawwal') {
                $jawwalSale=balance_sale::select('jawwal')->whereDate('created_at', today())->first();
                $x=$jawwalSale->jawwal;
                $x+=$request->amount;
                $jawwalSale=balance_sale::whereDate('created_at', today())->update([
                    'jawwal'=>$x
                ]);
            }

            elseif ($selectedValue === 'JawwalPay') {
                $jawwalpaySale=balance_sale::select('jawwalpay')->whereDate('created_at', today())->first();
                $x=$jawwalpaySale->jawwalpay;
                $x+=$request->amount;
                $jawwalpaySale=balance_sale::whereDate('created_at', today())->update([
                    'jawwalpay'=>$x
                ]);
            }

            elseif ($selectedValue === 'OoredooBills') {
                $ooredoobillsSale=balance_sale::select('ooredoobills')->whereDate('created_at', today())->first();
                $x=$ooredoobillsSale->ooredoobills;
                $x+=$request->amount;
                $ooredoobillsSale=balance_sale::whereDate('created_at', today())->update([
                    'ooredoobills'=>$x
                ]);
            }

            elseif ($selectedValue === 'Electricity') {
                $electricitySale=balance_sale::select('electricity')->whereDate('created_at', today())->first();
                $x=$electricitySale->electricity;
                $x+=$request->amount;
                $electricitySale=balance_sale::whereDate('created_at', today())->update([
                    'electricity'=>$x
                ]);
            }
        } else {

        }
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

        $Sales = dailydata::select('id','RecordType','item', 'amount', 'quantity', 'notes')->find($request -> id);

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
            'RecordType'=> $request->RecordType,
            'amount'=> $request->amount,
            'quantity'=> $request->quantity,
            'FirstPay'=> $request->FirstPay,
            'notes'=> $request->notes,
            'total'=> $request->amount * $request->quantity ,
            'user_name'=> $user_data->name
        ]);

        return redirect()->route('sales.show')->with(['success' => 'تم التحديث بنجاح']);

    }
/************************************ CustomerPayment *****************************/
    public function CustomerPaymentDelete(Request $request){

        $CusPay = CustomerPay::find($request -> id);

        if (!$CusPay){
            return redirect()->back()->with(['error' => ('لم يتم إيجاد الصف في قاعدة البيانات')]);
        }else {

            $CusPay->delete();

            return redirect()->back()->with(['success' => 'تم حذف البيان بنجاح ']);
        }
    }



    public function CustomerPaymentEdit(Request  $request)
    {
        $user_data = Auth::user();
        $CusPay = CustomerPay::find($request -> id);  // search in given table id only
        if (!$CusPay)
            return redirect()->back()->with(['success' => 'لم يتم إيجاد الصنف في قاعدة بياناتنا ']);

        $CusPay = CustomerPay::select('id', 'CustomerName','PayMethod', 'amount', 'notes')->find($request -> id);

        return view('Edit_Forms.CustomerPaymentEdit', compact('CusPay','user_data'));

    }

    public  function CustomerPaymentUpdate(Request $request){
        $user_data = Auth::user();
        $CusPay= CustomerPay::find($request -> id);
        if (!$CusPay)
            return redirect()->back()->with(['success' => 'لم يتم إيجاد الصنف في قاعدة بياناتنا ']);


        //update data
        $CusPay->update([
            'CustomerName'=> $request->CustomerName,
            'amount'=> $request->amount,
            'PayMethod'=> $request->PayMethod,
            'notes'=> $request->notes,
            'user_name'=> $user_data->name
        ]);

        return redirect()->route('CustomerPay.show')->with(['success' => 'تم التحديث بنجاح']);

    }


    /************************************ Loans *****************************/
    public function LoansDelete(Request $request){

        $loans = lenddata::find($request -> id);   // $Sales::where('id','') -> first();

        if (!$loans){
            return redirect()->back()->with(['error' => ('لم يتم إيجاد الصف في قاعدة البيانات')]);
        }else {

            $loans->delete();

            return redirect()->back()->with(['success' => 'تم حذف البيان بنجاح ']);
        }
    }



    public function LoansEdit(Request  $request)
    {
        $user_data = Auth::user();
        $loans = lenddata::find($request -> id);  // search in given table id only
        if (!$loans)
            return redirect()->back()->with(['success' => 'لم يتم إيجاد الصنف في قاعدة بياناتنا ']);

        $loans = lenddata::select('id', 'RecordType','item', 'amount','quantity','FirstPay', 'notes','debtorName')->find($request -> id);

        return view('Edit_Forms.LendEdit', compact('loans','user_data'));

    }

    public  function LoansUpdate(Request $request){
        $user_data = Auth::user();
        $loans= lenddata::find($request -> id);
        if (!$loans)
            return redirect()->back()->with(['success' => 'لم يتم إيجاد الصنف في قاعدة بياناتنا ']);


        //update data
        $loans->update([
            'item_name'=> $request->item_name,
            'RecordType'=> $request->RecordType,
            'amount'=> $request->amount,
            'quantity'=> $request->quantity,
            'total'=> $request->amount*$request->quantity,
            'debtor_name'=> $request->debtor_name,
            'notes'=> $request->notes,
            'user_name'=> $user_data->name
        ]);

        return redirect()->route('Loans.show')->with(['success' => 'تم التحديث بنجاح']);

    }

    /************************************ Outs *****************************/
    public function OutsDelete(Request $request){

        $Outs = Outs::find($request -> id);   // $Sales::where('id','') -> first();

        if (!$Outs){
            return redirect()->back()->with(['error' => ('لم يتم إيجاد الصف في قاعدة البيانات')]);
        }else {

            $Outs->delete();

            return redirect()->back()->with(['success' => 'تم حذف البيان بنجاح ']);
        }
    }



    public function OutsEdit(Request  $request)
    {
        $user_data = Auth::user();
        $Outs = Outs::find($request -> id);  // search in given table id only
        if (!$Outs)
            return redirect()->back()->with(['success' => 'لم يتم إيجاد الصنف في قاعدة بياناتنا ']);

        $Outs = Outs::select('id','RecordType','beneficiary', 'item', 'amount', 'notes')->find($request -> id);

        return view('Edit_Forms.OutEdit', get_defined_vars());

    }

    public  function OutsUpdate(Request $request){
        $user_data = Auth::user();
        $Outs= Outs::find($request -> id);
        if (!$Outs)
            return redirect()->back()->with(['success' => 'لم يتم إيجاد الصنف في قاعدة بياناتنا ']);


        //update data
        $Outs->update([
            'item_name'=> $request->item_name,
            'amount'=> $request->amount,
            'RecordType'=> $request->RecordType,
            'beneficiary'=> $request->beneficiary,
            'notes'=> $request->notes,
        ]);

        return redirect()->route('Outs.show')->with(['success' => 'تم التحديث بنجاح']);

    }



/************************************ Purchases *****************************/
    public function PurchasesDelete(Request $request){

        $Purchases = DealersBuy::find($request -> id);   // $Sales::where('id','') -> first();

        if (!$Purchases){
            return redirect()->back()->with(['error' => ('لم يتم إيجاد الصف في قاعدة البيانات')]);
        }else {
            $selectedValue = $Purchases->RecordType;

            if($selectedValue === 'Ooredoo') {
                $ooredooBaseBalance=balance_sale::select('ooredooin','innotes')->whereDate('created_at', today())->first();
                $x=$ooredooBaseBalance->ooredooin;
                $x-=$Purchases->amount;
                $n=$ooredooBaseBalance->innotes;
                $ooredooSale=balance_sale::whereDate('created_at', today())->update([
                    'ooredooin'=>$x,
                    'innotes'=>$n. "\n تم حذف قيمة $Purchases->amount   شيكل رصيد أوريدوا  "

                ]);

            } elseif ($selectedValue === 'Jawwal') {
                $jawwalBaseBalance=balance_sale::select('jawwalin','innotes')->whereDate('created_at', today())->first();
                $x=$jawwalBaseBalance->jawwalin;
                $x-=$Purchases->amount;
                $n=$jawwalBaseBalance->innotes;
                $jawwalSale=balance_sale::whereDate('created_at', today())->update([
                    'jawwalin'=>$x,
                    'innotes'=>$n. "\n تم حذف $Purchases->amount   شيكل رصيد جوال  "

                ]);
            }

            elseif ($selectedValue === 'JawwalPay') {
                $JawwalPayinBalance=balance_sale::select('jawwalpayin','innotes')->whereDate('created_at', today())->first();
                $x=$JawwalPayinBalance->jawwalpayin;
                $x-=$Purchases->amount;
                $n=$JawwalPayinBalance->innotes;
                $jawwalpayin=balance_sale::whereDate('created_at', today())->update([
                    'jawwalpayin'=>$x,
                    'innotes'=>$n. "\n تم حذف  $Purchases->amount   شيكل رصيد جوال باي  "

                ]);
            }

            elseif ($selectedValue === 'OoredooBills') {
                $ooredoobillsinBalance=balance_sale::select('ooredoobillsin','innotes')->whereDate('created_at', today())->first();
                $x=$ooredoobillsinBalance->ooredoobillsin	;
                $x-=$Purchases->amount;
                $n=$ooredoobillsinBalance->innotes;
                $ooredoobillsin=balance_sale::whereDate('created_at', today())->update([
                    'ooredoobillsin'=>$x,
                    'innotes'=>$n. "\n تم حذف  $Purchases->amount   شيكل رصيد فواتير اوريدوا  "

                ]);
            }

            elseif ($selectedValue === 'Electricity') {
                $ElectricityBaseBalance=balance_sale::select('electricityin','innotes')->whereDate('created_at', today())->first();
                $x=$ElectricityBaseBalance->electricityin;
                $x-=$Purchases->amount;
                $n=$ElectricityBaseBalance->innotes;
                $ElectricitySale=balance_sale::whereDate('created_at', today())->update([
                    'electricityin'=>$x,
                    'innotes'=>$n. "\n تم حذف  $Purchases->amount   شيكل رصيد كهرباء  "

                ]);
            }

            else {

            }

            $Purchases->delete();

            return redirect()->back()->with(['success' => 'تم حذف البيان بنجاح ']);
        }
    }



    public function PurchasesEdit(Request  $request)
    {
        $user_data = Auth::user();
        $Purchases = DealersBuy::find($request -> id);  // search in given table id only
        if (!$Purchases)
            return redirect()->back()->with(['success' => 'لم يتم إيجاد الصنف في قاعدة بياناتنا ']);

        $Purchases = DealersBuy::select('id', 'item','RecordType', 'amount', 'notes', 'SellerName')->find($request -> id);


        return view('Edit_Forms.DealersBuyEdit', compact('Purchases','user_data'));

    }

    public  function PurchasesUpdate(Request $request){
        $user_data = Auth::user();
        $Purchases= DealersBuy::find($request -> id);
        if (!$Purchases)
            return redirect()->back()->with(['success' => 'لم يتم إيجاد الصنف في قاعدة بياناتنا ']);


        //update data
        $Purchases->update([
            'item'=> $request->item_name,
            'amount'=> $request->amount,
            'SellerName'=> $request->DealerName,
            'RecordType'=> $request->RecordType,
            'notes'=> $request->notes,
            'user_name'=> $user_data->name
        ]);




        return redirect()->route('Purchases.show')->with(['success' => 'تم التحديث بنجاح']);

    }


    /************************************ PlatformBalance *****************************/
    public function PlatformBalanceDelete(Request $request){

        $PlatformBalances = PlatformBalance::find($request -> id);   // $Sales::where('id','') -> first();

        if (!$PlatformBalances){
            return redirect()->back()->with(['error' => ('لم يتم إيجاد الصف في قاعدة البيانات')]);
        }else {

            $PlatformBalances->delete();

            return redirect()->back()->with(['success' => 'تم حذف البيان بنجاح ']);
        }
    }



    public function PlatformBalanceEdit(Request  $request)
    {
        $user_data = Auth::user();
        $PlatformBalances = PlatformBalance::find($request -> id);  // search in given table id only
        if (!$PlatformBalances)
            return redirect()->back()->with(['success' => 'لم يتم إيجاد الصنف في قاعدة بياناتنا ']);

        $PlatformBalances = PlatformBalance::select('id','notes', 'OoredooBalance', 'JawwalBalance', 'JawwalPayBalance', 'ElectricityBalance', 'OoredooBillsBalance', 'BankOfPalestineBalance', 'BankAlQudsBalance', 'BalanceType')->find($request -> id);

        return view('Edit_Forms.PlatformsBalanceEdit', compact('PlatformBalances','user_data'));

    }

    public  function PlatformBalanceUpdate(Request $request){
        $user_data = Auth::user();
        $PlatformBalances= PlatformBalance::find($request -> id);
        if (!$PlatformBalances)
            return redirect()->back()->with(['success' => 'لم يتم إيجاد الصنف في قاعدة بياناتنا ']);


        //update data
        $PlatformBalances->update([
            'OoredooBalance'=> $request->OoredooBalance,
            'JawwalBalance'=> $request->JawwalBalance,
            'JawwalPayBalance'=> $request->JawwalPayBalance,
            'ElectricityBalance'=> $request->ElectricityBalance,
            'OoredooBillsBalance'=> $request->OoredooBillsBalance,
            'BankOfPalestineBalance'=> $request->BankOfPalestineBalance,
            'BankAlQudsBalance'=> $request->BankAlQudsBalance,
            'notes'=> $request->notes,
            'BalanceType'=> $request->BalanceType,
        ]);

        return redirect()->route('PlatformBalance.show')->with(['success' => 'تم التحديث بنجاح']);

    }




    public function StoreDealersBuy(Request $request){
        $user_data = Auth::user();

        $sales = DealersBuy::create([
            'item'=> $request->item_name,
            'amount'=> $request->amount,
            'SellerName'=> $request->DealerName,
            'RecordType'=> $request->RecordType,
            'notes'=> $request->notes,
            'UserName'=> $user_data->name
        ]);

            $selectedValue = $request->input('RecordType');

            if($selectedValue === 'Ooredoo') {
                $ooredooBaseBalance=balance_sale::select('ooredooin','innotes')->whereDate('created_at', today())->first();
                $x=$ooredooBaseBalance->ooredooin;
                $x+=$request->amount;
                $n=$ooredooBaseBalance->innotes;
                $ooredooSale=balance_sale::whereDate('created_at', today())->update([
                    'ooredooin'=>$x,
                     'innotes'=>$n. "\n تم إضافة $request->amount   شيكل رصيد أوريدوا التي تم شرائه اليوم "

                ]);

            } elseif ($selectedValue === 'Jawwal') {
                $jawwalBaseBalance=balance_sale::select('jawwalin','innotes')->whereDate('created_at', today())->first();
                $x=$jawwalBaseBalance->jawwalin;
                $x+=$request->amount;
                $n=$jawwalBaseBalance->innotes;
                $jawwalSale=balance_sale::whereDate('created_at', today())->update([
                    'jawwalin'=>$x,
                    'innotes'=>$n. "\n تم إضافة $request->amount   شيكل رصيد جوال التي تم شرائه اليوم "

                ]);
            }

            elseif ($selectedValue === 'JawwalPay') {
                $JawwalPayinBalance=balance_sale::select('jawwalpayin','innotes')->whereDate('created_at', today())->first();
                $x=$JawwalPayinBalance->jawwalpayin;
                $x+=$request->amount;
                $n=$JawwalPayinBalance->innotes;
                $jawwalpayin=balance_sale::whereDate('created_at', today())->update([
                    'jawwalpayin'=>$x,
                    'innotes'=>$n. "\n تم إضافة  $request->amount   شيكل رصيد جوال باي التي تم شرائه اليوم "

                ]);
            }

            elseif ($selectedValue === 'OoredooBills') {
                $ooredoobillsinBalance=balance_sale::select('ooredoobillsin','innotes')->whereDate('created_at', today())->first();
                $x=$ooredoobillsinBalance->ooredoobillsin	;
                $x+=$request->amount;
                $n=$ooredoobillsinBalance->innotes;
                $ooredoobillsin=balance_sale::whereDate('created_at', today())->update([
                    'ooredoobillsin'=>$x,
                    'innotes'=>$n. "\n تم إضافة  $request->amount   شيكل رصيد فواتير اوريدوا التي تم شرائه اليوم "

                ]);
            }

            elseif ($selectedValue === 'Electricity') {
                $ElectricityBaseBalance=balance_sale::select('electricityin','innotes')->whereDate('created_at', today())->first();
                $x=$ElectricityBaseBalance->electricityin;
                $x+=$request->amount;
                $n=$ElectricityBaseBalance->innotes;
                $ElectricitySale=balance_sale::whereDate('created_at', today())->update([
                    'electricityin'=>$x,
                    'innotes'=>$n. "\n تم إضافة  $request->amount   شيكل رصيد كهرباء التي تم شرائه اليوم "

                ]);
            }

         else {

        }


        return redirect()->back()->with(['success'=> 'تم الحفظ بنجاح']);
    }

    public function StoreOuts(Request $request){
        $user_data = Auth::user();



        if ($request->has('RecordType')) {
            $selectedValue = $request->input('RecordType');

            // تنفيذ العمليات المطلوبة بناءً على القيمة المختارة
            if($selectedValue === 'bankOfPalestine') {
                $bopBalance=balance_sale::select('bopin')->whereDate('created_at', today())->first();
                $x=$bopBalance->bopin;
                $x+=$request->amount;
                $bopBalance=balance_sale::whereDate('created_at', today())->update([
                    'bopin'=>$x
                ]);
                $sales = Outs::create([
                    'item'=> $request->item_name,
                    'amount'=> $request->amount,
                    'RecordType'=> $request->RecordType,
                    'beneficiary'=> $request->beneficiary,
                    'notes'=> "تم إخراجها إلى رصيد وسيلة الدفع المستخدمة",
                    'userName'=> $user_data->name
                ]);
            } elseif ($selectedValue === 'bankquds') {
                $bankqudsBalance=balance_sale::select('bankqudsin')->whereDate('created_at', today())->first();
                $x=$bankqudsBalance->bankqudsin;
                $x+=$request->amount;
                $bankqudsBalance=balance_sale::whereDate('created_at', today())->update([
                    'bankqudsin'=>$x
                ]);
            }

            elseif ($selectedValue === 'jawwalpay') {
                $jawwalpayBalance=balance_sale::select('jawwalpayin')->whereDate('created_at', today())->first();
                $x=$jawwalpayBalance->bankqudsin;
                $x+=$request->amount;
                $jawwalpayBalance=balance_sale::whereDate('created_at', today())->update([
                    'jawwalpayin'=>$x
                ]);
            }

        }
        else {
            $sales = Outs::create([
                'item'=> $request->item_name,
                'amount'=> $request->amount,
                'RecordType'=> $request->RecordType,
                'beneficiary'=> $request->beneficiary,
                'notes'=> $request->notes,
                'userName'=> $user_data->name
            ]);
        }

        return redirect()->back()->with(['success'=> 'تم الحفظ بنجاح']);
    }

    public function StoreLend(Request $request){
        $user_data = Auth::user();

        $sales = lenddata::create([
            'item'=> $request->item_name,
            'RecordType'=> $request->RecordType,
            'amount'=> $request->amount,
            'quantity'=> $request->quantity,
            'FirstPay'=> $request->FirstPay,
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
            'PayMethod'=> $request->PayMethod,
            'amount'=> $request->amount,
            'notes'=> $request->notes,
            'userName'=> $user_data->name
        ]);


            $selectedValue = $request->input('PayMethod');

            // تنفيذ العمليات المطلوبة بناءً على القيمة المختارة
            if($selectedValue === 'BankOfPalestine') {
                $bopBalance=balance_sale::select('bopin','innotes')->whereDate('created_at', today())->first();
                $x=$bopBalance->bop;
                $x+=$request->amount;
                $n=$bopBalance->innotes;
                $bopBalance=balance_sale::whereDate('created_at', today())->update([
                    'bopin'=>$x,
                    'innotes'=>$n."\n"." رصيد بنك فلسطين فيه$request->amount من دفعة $request->CustomerName  "

                ]);

            } elseif ($selectedValue === 'BankQuds') {
                $bankqudsBalance=balance_sale::select('bankqudsin','innotes')->whereDate('created_at', today())->first();
                $x=$bankqudsBalance->bankquds;
                $x+=$request->amount;
                $n=$bankqudsBalance->innotes;
                $bankqudsBalance=balance_sale::whereDate('created_at', today())->update([
                    'bankqudsin'=>$x,
                     'innotes'=>$n."\n"." رصيد بنك القدس فيه$request->amount من دفعة $request->CustomerName   "

                ]);
            }

            elseif ($selectedValue === 'JawwalPay') {
                $jawwalpayBalance=balance_sale::select('jawwalpayin','innotes')->whereDate('created_at', today())->first();
                $x=$jawwalpayBalance->jawwalpay;
                $x+=$request->amount;
                $n=$jawwalpayBalance->innotes;
                $jawwalpayyBalance=balance_sale::whereDate('created_at', today())->update([
                    'jawwalpayin'=>$x,
                    'innotes'=>$n."\n"." رصيد جوال باي فيه$request->amount من دفعة $request->CustomerName  "
                ]);
            }  else {

        }


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
            'BankOfPalestineBalance'=> $request->BankOfPalestineBalance,
            'BankAlQudsBalance'=> $request->BankAlQudsBalance,
            'BalanceType'=> $request->BalanceType,
            'notes'=> $request->notes,
            'userName'=> $user_data->name
        ]);
        return redirect()->back()->with(['success'=> 'تم الحفظ بنجاح']);
    }


    public function store_pay_to_merchant(Request $request){
        $user_data = Auth::user();
        $selectedValue = $request->input('PayMethod');




        if($selectedValue === 'bop') {
            $pay = Outs::create([
                'amount'=> $request->amount,
                'item'=> " دفعة إلى تاجر عن طريق $selectedValue",
                'beneficiary'=> $request->merchant_name,
                'notes'=> $request->notes,
                'userName'=> $user_data->name
            ]);
            $ooredooBaseBalance=balance_sale::select('bop','notes')->whereDate('created_at', today())->first();
            $x=$ooredooBaseBalance->bop;
            $x+=$request->amount;
            $n=$ooredooBaseBalance->notes;
            $ooredooSale=balance_sale::whereDate('created_at', today())->update([
                'bop'=>$x,
                'notes'=>$n. "\n تم دفع $request->amount   شيكل عبر بنك فلسطين لـ $request->merchant_name "

            ]);

        } elseif ($selectedValue === 'bankquds') {
            $pay = Outs::create([
                'amount'=> $request->amount,
                'item'=> " دفعة إلى تاجر عن طريق $selectedValue",
                'beneficiary'=> $request->merchant_name,
                'notes'=> $request->notes,
                'userName'=> $user_data->name
            ]);
            $bankqudsBalance=balance_sale::select('bankquds','notes')->whereDate('created_at', today())->first();
            $x=$bankqudsBalance->bankquds;
            $x+=$request->amount;
            $n=$bankqudsBalance->notes;
            $bankquds=balance_sale::whereDate('created_at', today())->update([
                'bankquds'=>$x,
                'notes'=>$n. "\n تم إضافة $request->amount   شيكل رصيد جوال التي تم شرائه اليوم "

            ]);
        }

        elseif ($selectedValue === 'jawwalpay') {
            $pay = Outs::create([
                'amount'=> $request->amount,
                'item'=> " دفعة إلى تاجر عن طريق $selectedValue",
                'beneficiary'=> $request->merchant_name,
                'notes'=> $request->notes,
                'userName'=> $user_data->name
            ]);
            $JawwalPayBalance=balance_sale::select('jawwalpay','notes')->whereDate('created_at', today())->first();
            $x=$JawwalPayBalance->jawwalpay;
            $x+=$request->amount;
            $n=$JawwalPayBalance->notes;
            $jawwalpayin=balance_sale::whereDate('created_at', today())->update([
                'jawwalpay'=>$x,
                'notes'=>$n. "\n تم إضافة  $request->amount   شيكل رصيد جوال باي التي تم شرائه اليوم "

            ]);
        }

        elseif ($selectedValue === 'under') {

          $note=note::create([
              'notes'=>" تم إخراج مبلغ $request->amount إلى $request->merchant_name من الخزينة بالاسفل ",
              'user_name'=>$user_data->name

          ]);
        }

        elseif ($selectedValue === 'check') {
            $note=note::create([
                'notes'=>" تم إخراج شيك بقيمة $request->amount إلى $request->merchant_name  ",
                'user_name'=>$user_data->name
            ]);
        }


        else {
            $Msg= "لم يتم تسجيل الدفعة، ما دام الدفع كاش توجه لتسجيل الدفعة من خلال صفحة المخرجات من الزر أدناه" ;
            $SUrl='OutsForm';
            return view('ErrorPage',compact('Msg','SUrl')) ;
        }

        return redirect()->back()->with(['success'=> 'تم الحفظ بنجاح']);
    }

    public function PlatformsBalanceForms(){
        $user_data = Auth::user();

        return view('Forms\PlatformsBalanceForms',compact('user_data'));
    }

    public function payToMerchantForm(){
        $user_data = Auth::user();

        return view('Forms\payToMerchant',compact('user_data'));
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



        return view('Show\CustomerPaymentsShow',get_defined_vars());
    }
    public function CustomerPaymentsShowWithDate(Request $request){

        $date = $request->input('date');
        $todayTotal = CustomerPay::whereDate('created_at', $date)->sum('amount');


        if ($date) {
            $CusPays= CustomerPay::whereDate('created_at', $date)
                ->get();

            return view('Show\CustomerPaymentsShow', get_defined_vars());
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
        $Msg="مدخلش الشرط";
        $SUrl="";
        $OoredooBalanceEnd="";
        if($todayOpenBal==null){
            $Msg= "انت لم تدخل الرصيد الافتتاحي لمحطات الشحن لهذا اليوم" ;
            $SUrl='PlatformBalanceForm';
            return view('ErrorPage',compact('Msg','SUrl')) ;
        } elseif ($todayCloseBal==null){
            $Msg=  "انت لم تدخل الرصيد النهائي لمحطات الشحن لهذا اليوم";
            $SUrl='PlatformBalanceForm';
             return view('ErrorPage',compact('Msg','SUrl')) ;

        }else {

           $OoredooBalanceEnd=$todayCloseBal->OoredooBalance-$todayOpenBal->OoredooBalance;
          $JawwalBalanceEnd=$todayCloseBal->JawwalBalance-$todayOpenBal->JawwalBalance;
           $JawwalPayBalanceEnd=$todayCloseBal->JawwalPayBalance-$todayOpenBal->JawwalPayBalance;
           $ElectricityBalanceEnd=$todayCloseBal->ElectricityBalance-$todayOpenBal->ElectricityBalance;
           $OoredooBillsBalanceEnd=$todayCloseBal->OoredooBillsBalance-$todayOpenBal->OoredooBillsBalance;
           $BankOfPalestineBalanceEnd=$todayCloseBal->BankOfPalestineBalance-$todayOpenBal->BankOfPalestineBalance;
           $BankAlQudsBalanceEnd=$todayCloseBal->BankAlQudsBalance-$todayOpenBal->BankAlQudsBalance;


        }

        return view('Show\PlatformBalanceShow', get_defined_vars());
    }





    public function PlatformBalanceShowWithDate(Request $request){

        $date = $request->input('date');


        if ($date) {
            $PlatsBalance= PlatformBalance::whereDate('created_at', $date)
                ->get();


            $todayOpenBal=PlatformBalance::whereDate('created_at',$date )->where('BalanceType','افتتاحي')->first();
            $todayCloseBal=PlatformBalance::whereDate('created_at',$date )->where('BalanceType','نهائي')->first();
            $Msg="";
            $SUrl="";
            $OoredooBalanceEnd="";
            if($todayOpenBal==null){
                $Msg=  "انت لم تدخل الرصيد الافتتاحي لمحطات الشحن لهذا اليوم";
                $SUrl='PlatformBalanceForm';
                return view('ErrorPage',compact('Msg','SUrl')) ;
            } elseif ($todayCloseBal==null){
                $Msg=  "انت لم تدخل الرصيد النهائي لمحطات الشحن لهذا اليوم";
                $SUrl='PlatformBalanceForm';
                return view('ErrorPage',compact('Msg','SUrl')) ;

            }else {

                $OoredooBalanceEnd=$todayCloseBal->OoredooBalance-$todayOpenBal->OoredooBalance;
                $JawwalBalanceEnd=$todayCloseBal->JawwalBalance-$todayOpenBal->JawwalBalance;
                $JawwalPayBalanceEnd=$todayCloseBal->JawwalPayBalance-$todayOpenBal->JawwalPayBalance;
                $ElectricityBalanceEnd=$todayCloseBal->ElectricityBalance-$todayOpenBal->ElectricityBalance;
                $OoredooBillsBalanceEnd=$todayCloseBal->OoredooBillsBalance-$todayOpenBal->OoredooBillsBalance;
                $BankOfPalestineBalanceEnd=$todayCloseBal->BankOfPalestineBalance-$todayOpenBal->BankOfPalestineBalance;
                $BankAlQudsBalanceEnd=$todayCloseBal->BankAlQudsBalance-$todayOpenBal->BankAlQudsBalance;


            }

            return view('Show\PlatformBalanceShow',get_defined_vars());
        } else {

            return route('PlatformBalance.show');
        }
    }




    public function DailySummary(){

        $openbalance=PlatformBalance::whereDate('created_at',today() )->where('BalanceType','افتتاحي')->first();
        $balancsales=balance_sale::whereDate('created_at',today())->first();
        $totalOoredooLoan=lenddata::whereDate('created_at',today())->where('RecordType','Ooredoo')->sum('amount');
        $totalJawwalLoan=lenddata::whereDate('created_at',today())->where('RecordType','Jawwal')->sum('amount');
        $totalOoredooBillsLoan=lenddata::whereDate('created_at',today())->where('RecordType','OoredooBills')->sum('amount');
        $totalJawwalPayLoan=lenddata::whereDate('created_at',today())->where('RecordType','JawwalPay')->sum('amount');
        $totalElectricityLoan=lenddata::whereDate('created_at',today())->where('RecordType','Electricity')->sum('amount');

        ################## Platform Dealer Buy #########################

        $Balancein=balance_sale::whereDate('created_at',today() )->first();
//        $TotalOoredooBuyDealer=balance_sale::whereDate('created_at',today() )->where('RecordType','Ooredooin');
//        $TotalJawwalBuyDealer=balance_sale::whereDate('created_at',today() )->where('RecordType','Jawwalin');
          $TotalJawwalPayBuyDealer=DealersBuy::whereDate('created_at',today() )->where('RecordType','JawwalPay')->sum('amount');
//        $TotalOoredooBillsBuyDealer=balance_sale::whereDate('created_at',today() )->where('RecordType','OoredooBillsin');
//        $TotalElectricityBuyDealer=balance_sale::whereDate('created_at',today() )->where('RecordType','Electricityin');
//        $TotalBankOfPalestine=balance_sale::whereDate('created_at',today() )->where('RecordType','OoredooBillsin');
//        $TotalBankQuds=balance_sale::whereDate('created_at',today() )->where('RecordType','Electricityin');

        $TotalCustPay=CustomerPay::whereDate('created_at',today() )->sum('amount');
        $TotalSales=dailydata::whereDate('created_at',today() )->sum('total');
        $TotalBuy=DealersBuy::whereDate('created_at',today() )->sum('amount');

        if(!$openbalance){
            $Msg= "عليك أولاً إدخال الارصدة الافتاحية الخاصة بمحطات الشحن" ;
            $SUrl='PlatformBalanceForm';
            return view('ErrorPage',get_defined_vars()) ;
        }else {
            $OoredooEnd = $openbalance->OoredooBalance - $balancsales->ooredoo - $totalOoredooLoan + $Balancein->Ooredooin;
            $OoredooBillsEnd = $openbalance->OoredooBillsBalance - $balancsales->ooredoobills - $totalOoredooBillsLoan + $Balancein->OoredooBillsin;
            $JawwalEnd = $openbalance->JawwalBalance - $balancsales->jawwal - $totalJawwalLoan + $Balancein->Jawwalin;
            $JawwalpayEnd = $openbalance->JawwalPayBalance - $balancsales->jawwalpay - $totalJawwalPayLoan + $Balancein->JawwalPayin;
            $ElectricityEnd = $openbalance->ElectricityBalance - $balancsales->electricity - $totalElectricityLoan + $Balancein->Electricityin;
            $BopEnd = $openbalance->BankOfPalestineBalance - $balancsales->bop+$Balancein->bopin;
            $BankQudsEnd = $openbalance->BankAlQudsBalance - $balancsales->bankquds+$Balancein->bankqudsin;
        }
        ################## Entire & Outs & Final #########################

        #Entire
        $DailySalesTotal=dailydata::whereDate('created_at', today())->sum('total');
        $CustomerPayTotal=CustomerPay::whereDate('created_at', today())->sum('amount');
        $firstPayTotal=lenddata::whereDate('created_at', today())->sum('FirstPay');

        $dailyEntireTotal=$DailySalesTotal+$CustomerPayTotal+$firstPayTotal;

        #Outs
        $OutsTotal=Outs::whereDate('created_at', today())->where('RecordType','General')->sum('amount');

        #Final
        $finalBalance=$dailyEntireTotal-$OutsTotal;





        return view('SummaryPage',get_defined_vars());
    }

    public function print_daily_date()
    {

        $openbalance=PlatformBalance::whereDate('created_at',today() )->where('BalanceType','افتتاحي')->first();
        $balancsales=balance_sale::whereDate('created_at',today())->first();
        $totalOoredooLoan=lenddata::whereDate('created_at',today())->where('RecordType','Ooredoo')->sum('amount');
        $totalJawwalLoan=lenddata::whereDate('created_at',today())->where('RecordType','Jawwal')->sum('amount');
        $totalOoredooBillsLoan=lenddata::whereDate('created_at',today())->where('RecordType','OoredooBills')->sum('amount');
        $totalJawwalPayLoan=lenddata::whereDate('created_at',today())->where('RecordType','JawwalPay')->sum('amount');

        ################## Platform Dealer Buy & CustPay & DealerBuy & Sales #########################

        $TotalOoredooBuyDealer=DealersBuy::whereDate('created_at',today() )->where('RecordType','Ooredoo')->sum('amount');
        $TotalJawwalBuyDealer=DealersBuy::whereDate('created_at',today() )->where('RecordType','Jawwal')->sum('amount');
        $TotalJawwalPayBuyDealer=DealersBuy::whereDate('created_at',today() )->where('RecordType','JawwalPay')->sum('amount');
        $TotalOoredooBillsBuyDealer=DealersBuy::whereDate('created_at',today() )->where('RecordType','OoredooBills')->sum('amount');
        $TotalElectricityBuyDealer=DealersBuy::whereDate('created_at',today() )->where('RecordType','Electricity')->sum('amount');




        ################## Platform End Balance #########################
        $OoredooEnd=$openbalance->OoredooBalance-$balancsales->ooredoo-$totalOoredooLoan+ $TotalOoredooBuyDealer;
        $OoredooBillsEnd=$openbalance->OoredooBillsBalance-$balancsales->ooredoobills-$totalOoredooBillsLoan+$TotalOoredooBillsBuyDealer;
        $JawwalEnd=$openbalance->JawwalBalance-$balancsales->jawwal-$totalJawwalLoan+$TotalJawwalBuyDealer;
        $JawwalpayEnd=$openbalance->JawwalPayBalance-$balancsales->jawwalpay-$totalJawwalPayLoan+$TotalJawwalPayBuyDealer;
        $BopEnd=$openbalance->BankOfPalestineBalance-$balancsales->bop;
        $BankQudsEnd=$openbalance->BankAlQudsBalance-$balancsales->bankquds;

        ################## Entire & Outs & Final #########################

        #Entire
        $DailySalesTotal=dailydata::whereDate('created_at', today())->sum('total');
        $CustomerPayTotal=CustomerPay::whereDate('created_at', today())->sum('amount');
        $firstPayTotal=lenddata::whereDate('created_at', today())->sum('FirstPay');

        $dailyEntireTotal=$DailySalesTotal+$CustomerPayTotal+$firstPayTotal;

        #Outs
        $OutsTotal=Outs::whereDate('created_at', today())->sum('amount');

        #Final
        $finalBalance=$dailyEntireTotal-$OutsTotal;






        // استدعاء مكتبة dompdf
        $dompdf = new Dompdf();


        // قم بتعيين HTML الخاص بالصفحة التي ترغب في تحويلها إلى PDF
        $html = view('SummaryPage',get_defined_vars())->render();

        // تحميل HTML إلى مكتبة dompdf
        $dompdf->loadHtml($html);

        // إعداد المكتبة لتوليد PDF
        $dompdf->setPaper('A4', 'portrait');

        // توليد الصفحة PDF
        $dompdf->render();
       $filename='DailyData_' . Carbon::now()->format('Y-m-d') . '.pdf';

        // حفظ الصفحة PDF على القرص
        $dompdf->stream($filename, ["Attachment" => false]);
    }
################################ daily notes ###################################
    public function DailyNotesShow(){
      $date=today()->format('Y-m-d');
        $note=note::whereDate('created_at',today())->get();
     return view('DailyNotesShow',get_defined_vars());
    }
    public function storenotes(Request $request){
      $date=today()->format('Y-m-d');
        $user_data = Auth::user();
      $dayNotes=note::create([
          'notes'=>$request->notes,
          'user_name'=>$user_data->name
      ]);
        return redirect()->back()->with(['success'=> 'تم الحفظ بنجاح']);
    }

    public function noteDelete(Request $request){

        $note = note::find($request -> id);   // $Sales::where('id','') -> first();

        if (!$note){
            return redirect()->back()->with(['success' => 'لم يتم إيجاد الصف في قاعدة البيانات']);
        }else {

            $note->delete();

            return redirect()->back()->with(['success' => 'تم حذف البيان بنجاح ']);
        }
    }



    public function noteEdit(Request  $request)
    {
        $user_data = Auth::user();
        $note = note::find($request -> id);  // search in given table id only
        if (!$note)
            return redirect()->back()->with(['success' => 'لم يتم إيجاد الصنف في قاعدة بياناتنا ']);

        $note = note::select('id', 'notes','user_name')->find($request -> id);

        return view('Edit_Forms.EditDailyNotes', get_defined_vars());

    }

    public  function noteUpdate(Request $request){
        $user_data = Auth::user();
        $note= note::find($request -> id);
        if (!$note)
            return redirect()->back()->with(['success' => 'لم يتم إيجاد الصنف في قاعدة بياناتنا ']);


        //update data
        $note->update([
            'notes'=> $request->notes,
            'user_name'=> $user_data->name
        ]);

        return redirect()->route('DailyNotes.show')->with(['success' => 'تم التحديث بنجاح']);

    }
}









