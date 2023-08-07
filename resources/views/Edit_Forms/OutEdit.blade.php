@extends('layouts.app')
@section('content')

<head>
    <title> تعديل مُخرج</title>
    <link rel="stylesheet" href="{{ asset('css/Forms.css') }}">
</head>
<body>
<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <h1>تعديل مُخرج</h1>
    <form action="{{route('Outs.Update',$Outs->id)}}" method="post">
        @csrf

        <div class="custom-select">
            نوع العملية:
            <select id="RecordType" name="RecordType" >

                <option @if($Outs->RecordType === 'General') selected @endif value="General" >مخرجات عامة </option>
                <option @if($Outs->RecordType === 'bop') selected @endif value="bankOfPalestine" >بنك فلسطين </option>
                <option @if($Outs->RecordType === 'bankquds') selected @endif value="bankquds" > بنك القدس </option>

            </select>
        </div>

        <div class="form-group">
            <label for="item_name">البيان</label>
            <input  placeholder="ما هو الذي تم إخراجه ؟" type="text" id="item_name" name="item_name" required value="{{$Outs->item}}">
        </div>

        <div class="form-group">
            <label for="amount">المبلغ:</label>
            <input  placeholder="أدخل المبلغ" type="number" id="amount" name="amount" required value="{{$Outs->amount}}">
        </div>

        <div class="form-group">
            <label for="beneficiary">مُخرج إلى: "اختياري"</label>
            <input  placeholder="إلى من تم إخراج الأموال؟ 'اختياري'"  type="text" id="beneficiary" name="beneficiary" value="{{$Outs->beneficiary}}" >
        </div>

        <div class="form-group">
            <label for="notes">ملاحظات:</label>
            <textarea  placeholder="اكتب ملاحظات إذا كان هناك أي ارشادات " id="notes" name="notes" >{{$Outs->notes}}</textarea>
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
