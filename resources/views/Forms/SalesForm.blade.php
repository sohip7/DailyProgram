@extends('layouts.app')
@section('content')

<head>
    <title>إضافة صنف جديد</title>
    <link rel="stylesheet" href="{{ asset('css/Forms.css') }}">
</head>

<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

        @if(Session::has('x'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('x') }}
        </div>
    @endif
    <h1>إضافة صنف جديد</h1>
    <form class="form-group" action="{{route('sales.store')}}" method="post">
        @csrf

        <div class="custom-select">
            نوع العملية:
            <select id="RecordType" name="RecordType" >

                <option value="General" selected>مبيعات عامة </option>
                <!--<option value="OoreodooSim" >شريحة أوريدوا </option>-->
                <option value="Ooredoo" >رصيد أوريدوا </option>
                <option value="Jawwal" >رصيد جوال </option>
                <option value="OoredooBills">تسديد فاتورة أوريدوا </option>
                <option value="JawwalPay">شحن جوال باي</option>
                <option value="Electricity"> رصيد كهرباء</option>
                <!-- يمكنك إضافة المزيد من الخيارات هنا -->
            </select>
        </div>


        <div class="form-group">
            <label for="item_name">اسم الصنف:</label>
            <input  placeholder="أدخل اسم الصنف الذي تم بيعه" type="text" id="item_name" name="item_name" required>
        </div>

        <div class="form-group">
            <label for="amount">المبلغ:</label>
            <input  placeholder="أدخل المبلغ" type="number" id="amount" name="amount" required>
        </div>

        <div class="form-group">
            <label for="quantity">الكمية:</label>
            <input type="number" id="quantity" name="quantity" value="1">
        </div>

        <div class="form-group">
            <label for="notes">ملاحظات:</label>
            <textarea  placeholder="اكتب ملاحظات إذا كان هناك أي ارشادات " id="notes" name="notes"></textarea>
        </div>
        <label class="label" for="UserConfirm">
            هل أنت {{$user_data->name}}
            <input  id="UserConfirm" type="checkbox" required>
        </label>

        <button type="submit">إضافة</button>
    </form>
{{--        <a href="{{ route('sales.show') }}" class="btn btn-primary">عرض حركات تسجيل الأصناف اليوم</a>--}}

</div>



@endsection
