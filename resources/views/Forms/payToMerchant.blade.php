@extends('layouts.app')
@section('content')

<head>
    <title>دفع إلى تاجر</title>
    <link rel="stylesheet" href="{{ asset('css/Forms.css') }}">
</head>
<body>
<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <h1>دفع إلى تاجر</h1>
    <form action="{{route('payToMerchant.store')}}" method="post">
        @csrf

        <div class="custom-select">
            طريقة الدفع:
            <select id="PayMethod" name="PayMethod">
                <option value="Cash" selected>كاش</option>
                <option value="bop">بنك فلسطين </option>
                <option value="bankquds">بنك القدس </option>
                <option value="jawwalpay">جوال باي</option>
                <option value="under">من الخزنة</option>
                <option value="check">شيك </option>
            </select>


        </div>

        <div class="form-group">
            <label for="amount">المبلغ:</label>
            <input  placeholder="أدخل المبلغ" type="number" id="amount" name="amount" required>
        </div>


        <div class="form-group">
            <label for="merchant_name">اسم التاجر:</label>
            <input  placeholder="أدخل اسم التاجر" type="text" id="merchant_name" name="merchant_name" required>
        </div>

        <div class="form-group">
            <label for="notes">ملاحظات:</label>
            <textarea  placeholder="اكتب ملاحظات إذا كان هناك أي ارشادات " id="notes" name="notes"></textarea>
        </div>

        <label for="UserConfirm">
            هل أنت {{$user_data->name}}
            <input  id="UserConfirm" type="checkbox" required>
        </label>

        <button type="submit">إضافة</button>


    </form>

</div>
</body>


@endsection
