@extends('layouts.app')
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
    <h1>تعديل صنف مبيعات</h1>
    <form class="form-group" action="{{route('Sales.Update',$Sales->id)}}" method="post">
        @csrf

        <div class="custom-select">
            نوع العملية:
            <select id="RecordType" name="RecordType" >

                <option @if($Sales->RecordType === 'General') selected @endif value="General" >مبيعات عامة </option>
                <option @if($Sales->RecordType === 'Ooredoo') selected @endif value="Ooredoo" >رصيد أوريدوا </option>
                <option @if($Sales->RecordType === 'Jawwal') selected @endif value="Jawwal" >رصيد جوال </option>
                <option @if($Sales->RecordType === 'OoredooBills') selected @endif value="OoredooBills">تسديد فاتورة أوريدوا </option>
                <option @if($Sales->RecordType === 'JawwalPay') selected @endif value="JawwalPay">شحن جوال باي</option>
                <option @if($Sales->RecordType === 'Electricity') selected @endif value="Electricity"> رصيد كهرباء</option>
                <!-- يمكنك إضافة المزيد من الخيارات هنا -->
            </select>
        </div>

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

        <div class="form-group">
            <label for="notes">ملاحظات:</label>
            <textarea  placeholder="اكتب ملاحظات إذا كان هناك أي ارشادات " id="notes" name="notes"  >{{$Sales->notes}}</textarea>
        </div>
        <label class="label" for="UserConfirm">
            هل أنت {{$user_data->name}}
            <input  id="UserConfirm" type="checkbox" required>
        </label>

        <button type="submit">حفظ</button>
    </form>

</div>



@endsection
