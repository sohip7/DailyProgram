@extends('layouts.app')
@section('content')

<head>
    <title> إضافة مُخرج جديد</title>
    <link rel="stylesheet" href="{{ asset('css/Forms.css') }}">
</head>
<body>
<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <h1>إضافة مُخرج جديد</h1>
    <form action="{{route('Outs.store')}}" method="post">
        @csrf
        <div class="custom-select">
            نوع العملية:
            <select id="RecordType" name="RecordType" >

                <option  value="General" >مخرجات عامة </option>
                <option  value="bankOfPalestine" >بنك فلسطين </option>
                <option value="bankquds" > بنك القدس </option>
                <option value="jawwalpay" > جوال باي </option>

            </select>
        </div>
        <div class="form-group">
            <label for="item_name">البيان</label>
            <input  placeholder="ما هو الذي تم إخراجه ؟" type="text" id="item_name" name="item_name" required>
        </div>



        <div class="form-group">
            <label for="amount">المبلغ:</label>
            <input  placeholder="أدخل المبلغ" type="number" id="amount" name="amount" required>
        </div>

        <div class="form-group">
            <label for="beneficiary">مُخرج إلى: "اختياري"</label>
            <input  placeholder="إلى من تم إخراج الأموال؟ 'اختياري'"  type="text" id="beneficiary" name="beneficiary" >
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
