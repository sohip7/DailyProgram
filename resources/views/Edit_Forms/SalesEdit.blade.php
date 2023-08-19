@extends('layouts.app')
@section('title','تعديل مبيعات يومية')
@section('content')

<head>
    <title>تعديل بيان مبيعات</title>
    <link rel="stylesheet" href="{{ asset('css/Forms.css') }}">
</head>

<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
        @if(Session::has('Error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('Error') }}
        </div>
    @endif
    <h1>تعديل صنف مبيعات</h1>
        <h6 class="text-danger"> <span style="font-size: 20px" class="required-label"> </span>   تشير إلى أن الحقل مطلوب</h6>

        <form class="form-group" action="{{route('Sales.Update',$Sales->id)}}" method="post">
        @csrf

        <div class="custom-select">
            نوع العملية:
            <select id="RecordType" name="RecordType"  >

                <option @if($Sales->RecordType === 'General') selected @endif value="General" >مبيعات عامة </option>
                <option @if($Sales->RecordType === 'OoredooSim') selected @endif value="OoredooSim" >شريحة أوريدوا </option>
                <option @if($Sales->RecordType === 'Ooredoo') selected @endif value="Ooredoo" >رصيد أوريدوا </option>
                <option @if($Sales->RecordType === 'Jawwal') selected @endif value="Jawwal" >رصيد جوال </option>
                <option @if($Sales->RecordType === 'OoredooBills') selected @endif value="OoredooBills">تسديد فاتورة أوريدوا </option>
                <option @if($Sales->RecordType === 'JawwalPay') selected @endif value="JawwalPay">شحن جوال باي</option>
                <option @if($Sales->RecordType === 'Electricity') selected @endif value="Electricity"> رصيد كهرباء</option>
                <!-- يمكنك إضافة المزيد من الخيارات هنا -->
            </select>
        </div>
            @if($Sales->RecordType === 'JawwalPay')
            <div  id class="custom-select">
                <!-- JPATS=> jawwal pay account type-->
                <div  id="JPATS" class="custom-select">
                    نوع الحساب الذي تم الايداع منه:
                    <select id="JPAccountType" name="JPAccountType"  >
                        <option  value="merchant"  >حساب التاجر </option>
                        <option @if($JPCbalance_inout) @if($JPCbalance_inout->jawwalpay_account_type == 'agent') selected @endif @endif value="agent" >حساب الوكيل </option>
                        <!-- يمكنك إضافة المزيد من الخيارات هنا -->
                    </select>
                </div>
            </div>
            @endif


        <div class="form-group">
            <label for="item_name">اسم الصنف:</label>
            <input  placeholder="أدخل اسم الصنف الذي تم بيعه" type="text" id="item_name" name="item_name" required value="{{$Sales->item}}">
        </div>

        <div class="form-group">
            <label for="amount">المبلغ:</label>
            <input  placeholder="أدخل المبلغ" type="number" id="amount" name="amount" required value="{{$Sales->amount}}">
        </div>

        <div class="form-group">
            <label for="quantity">الكمية:</label>
            <input type="number" id="quantity" name="quantity" value="{{$Sales->quantity}}" >
        </div>
        @if($loans_ooredooSim)
        <div @if($loans_ooredooSim) style="display: block"  @endif id="actP" class="form-group" style="display: none" >
            <label for="ActivePrice">رسوم التفعيل:</label>
            <input type="number" id="ActivePrice" name="ActivePrice"  value="{{$loans_ooredooSim->amount}}" >
        </div>
        @endif



        <div class="form-group">
            <label for="notes">ملاحظات:</label>
            <textarea  placeholder="اكتب ملاحظات إذا كان هناك أي ارشادات " id="notes" name="notes"  >{{$Sales->notes}}</textarea>
        </div>
        <label class="label" for="UserConfirm">
            هل أنت {{$user_data->name}}
            <input  class="UserCheckBox" id="UserConfirm" type="checkbox" required>
        </label>

        <button type="submit">حفظ</button>
    </form>


</div>



@endsection
