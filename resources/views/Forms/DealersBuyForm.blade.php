@extends('layouts.app')
@section('content')

<head>
    <title> إضافة مشتريات جديد</title>
    <link rel="stylesheet" href="{{ asset('css/Forms.css') }}">
</head>
<body>
<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <h1>إضافة مشتريات جديد</h1>
        <h6 class="text-danger"> <span style="font-size: 20px" class="required-label"> </span>   تشير إلى أن الحقل مطلوب</h6>
        <form action="{{route('DealerBuy.store')}}" method="post">
        @csrf
        <div class="custom-select">
            نوع العملية:
            <select id="RecordType" name="RecordType">
                <option value="General" selected>مشتريات عامة </option>
                <option value="Ooredoo">رصيد أوريدوا </option>
                <option value="Jawwal">رصيد جوال </option>
                <option value="OoredooBills"> فواتير أوريدوا </option>
                <option value="JawwalPay"> جوال باي</option>
                <option value="Electricity"> كهرباء</option>
            </select>
        </div>
        <div class="form-group">
            <label for="item_name">البيان:<span class="required-label"></span></label>
            <input  placeholder="ما هو الذي تم شراءه ؟" type="text" id="item_name" name="item_name" required>
        </div>


        <div class="form-group">
            <label for="amount">المبلغ:<span class="required-label"></span></label>
            <input  placeholder="أدخل المبلغ" type="number" id="amount" name="amount" required>
        </div>

        <div class="form-group">
            <label for="DealerName">اسم التاجر:<span class="required-label"></span></label>
            <input  placeholder="ما هو اسم التاجر او الشخص الذي تم الشراء منها ؟" type="text" id="DealerName" name="DealerName" required>
        </div>

        <div class="form-group">
            <label for="notes">ملاحظات:</label>
            <textarea  placeholder="اكتب ملاحظات إذا كان هناك أي ارشادات " id="notes" name="notes"></textarea>
        </div>




        <label for="UserConfirm">
            هل أنت {{$user_data->name}}
            <span class="required-label"></span>
            <input  id="UserConfirm" type="checkbox" required>
        </label>

        <button type="submit">إضافة</button>
    </form>
</div>
</body>


@endsection
