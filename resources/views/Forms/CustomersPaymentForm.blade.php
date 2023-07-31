@extends('layouts.app')
@section('content')

<head>
    <title>إضافة دفعة من زبون</title>
    <link rel="stylesheet" href="{{ asset('css/Forms.css') }}">
</head>
<body>
<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <h1>إضافة دفعة من زبون</h1>
    <form action="{{route('CustomerPay.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="CustomerName">اسم الزبون:</label>
            <input  placeholder="أدخل اسم الزبون الذي دفع" type="text" id="CustomerName" name="CustomerName" required>
        </div>

        <div class="form-group">
            <label for="amount">المبلغ:</label>
            <input  placeholder="أدخل المبلغ" type="number" id="amount" name="amount" required>
        </div>

        <div class="form-group">
            <label for="notes">ملاحظات:</label>
            <textarea  placeholder="اكتب ملاحظات إذا كان مثلا هناك طلب لتعديل موعد الدفعات الشهرية " id="notes" name="notes"></textarea>
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
