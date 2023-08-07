@extends('layouts.app')
@section('content')

<head>
    <title>تعديل دَين</title>
    <link rel="stylesheet" href="{{ asset('css/Forms.css') }}">
</head>
<body>
<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <h1>تعديل دَين</h1>
    <form action="{{route('Loans.Update',$loans->id)}}" method="post">
        @csrf
        <div class="custom-select">
            نوع العملية:
            <select id="RecordType" name="RecordType" >

                <option @if($loans->RecordType === 'General') selected @endif value="General" >مبيعات عامة </option>
                <option @if($loans->RecordType === 'Ooredoo') selected @endif value="Ooredoo" >رصيد أوريدوا </option>
                <option @if($loans->RecordType === 'Jawwal') selected @endif value="Jawwal" >رصيد جوال </option>
                <option @if($loans->RecordType === 'OoredooBills') selected @endif value="OoredooBills">تسديد فاتورة أوريدوا </option>
                <option @if($loans->RecordType === 'JawwalPay') selected @endif value="JawwalPay">شحن جوال باي</option>
                <option @if($loans->RecordType === 'Electricity') selected @endif value="Electricity"> رصيد كهرباء</option>
                <!-- يمكنك إضافة المزيد من الخيارات هنا -->
            </select>
        </div>

        <div class="form-group">
            <label for="item_name">اسم الصنف:</label>
            <input  placeholder="أدخل اسم الصنف الذي تم إدانته" type="text" id="item_name" name="item_name" required value="{{$loans->item}}">
        </div>

        <div class="form-group">
            <label for="amount">المبلغ:</label>
            <input  placeholder="أدخل المبلغ" type="number" id="amount" name="amount" required value="{{$loans->amount}}">
        </div>

        <div class="form-group">
            <label for="quantity">الكمية:</label>
            <input type="number" id="quantity" name="quantity" required value="{{$loans->quantity}}">
        </div>


        <div  id="quantity" class="form-group">
            <label  for="FirstPay">الدفعة الاولى:</label>
            <input type="number" id="FirstPay" name="FirstPay" value="{{$loans->FirstPay}}">
        </div>


        <div class="form-group">
            <label for="debtor_name">اسم المدين:</label>
            <input  placeholder="أدخل الشخص المدين" type="text" id="debtor_name" name="debtor_name" required value="{{$loans->debtorName}}">
        </div>

        <div class="form-group">
            <label for="notes">ملاحظات:</label>
            <textarea  placeholder="اكتب ملاحظات إذا كان هناك أي ارشادات " id="notes" name="notes" >{{$loans->notes}}</textarea>
        </div>
        <label for="UserConfirm">
            هل أنت {{$user_data->name}}
            <input  id="UserConfirm" type="checkbox" required>
        </label>

        <button type="submit">حفظ</button>
    </form>
</div>
</body>


@endsection
