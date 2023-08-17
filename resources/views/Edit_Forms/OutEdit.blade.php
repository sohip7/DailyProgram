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
        <h6 class="text-danger"> <span style="font-size: 20px" class="required-label"> </span>   تشير إلى أن الحقل مطلوب</h6>

        <form action="{{route('Outs.Update',$Outs->id)}}" method="post">
        @csrf

        <div class="custom-select">
            نوع العملية:
            <select id="RecordType" name="RecordType" >

                <option @if($Outs->RecordType === 'Cash') selected @endif value="Cash" >مخرجات عامة نقداً </option>
                <option @if($Outs->RecordType === 'bankOfPalestine') selected @endif value="bankOfPalestine" >بنك فلسطين </option>
                <option @if($Outs->RecordType === 'bankquds') selected @endif value="bankquds" > بنك القدس </option>
                <option @if($Outs->RecordType === 'JawwalPay') selected @endif value="JawwalPay" > جوال باي </option>

            </select>
        </div>

        <div class="form-group">
            <label for="item_name">البيان:<span class="required-label"></span></label>
            <input  placeholder="ما هو الذي تم إخراجه ؟" type="text" id="item_name" name="item_name" required value="{{$Outs->item}}">
        </div>

        <div class="form-group">
            <label for="amount">المبلغ:<span class="required-label"></span></label>
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
            <span class="required-label"></span>
            <input  id="UserConfirm" type="checkbox" required>
        </label>

        <button type="submit">حفظ</button>
    </form>
</div>
</body>


@endsection
