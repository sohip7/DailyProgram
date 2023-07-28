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
    <h1>إضافة صنف جديد</h1>
    <form action="{{route('sales.store')}}" method="post">
        @csrf
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
        <label for="UserConfirm">
            هل أنت {{$user_data->name}}
            <input  id="UserConfirm" type="checkbox" required>
        </label>

        <button type="submit">إضافة</button>
    </form>
</div>



@endsection
