@extends('layouts.app')
@section('content')

<head>
    <title>إضافةأرصدة المحطات</title>
    <link rel="stylesheet" href="{{ asset('css/Forms.css') }}">
</head>
<body>
<div class="container">
    <h1>إدخال أرصدة محطات الشحن</h1>
    <form action="" method="post">
        @csrf

        <div class="form-group">
            <label for="AhlanMobBalance">رصيد أهلاً موبايل:</label>
            <input  placeholder="أدخل رصيد المحطة الحالي" type="number" id="AhlanMobBalance" name="AhlanMobBalance" required>
        </div>

        <div class="form-group">
            <label for="amount">رصيد جوال:</label>
            <input  placeholder="أدخل رصيد المحطة الحالي" type="number" id="amount" name="amount" required>
        </div>

        <div class="form-group">
            <label for="JawwalPayBalance">رصيد جوال باي:</label>
            <input  placeholder="أدخل رصيد المحطة الحالي" type="number" id="JawwalPayBalance" name="JawwalPayBalance" required>
        </div>

        <div class="form-group">
            <label for="ElectricityBalance">رصيد الكهرباء:</label>
            <input  placeholder="أدخل إجمالي رصيد الديكسين والعادي" type="number" id="ElectricityBalance" name="ElectricityBalance" required>
        </div>

        <div class="form-group">
            <label for="OoredooBillsBalance">رصيد أوريدوا الفواتير:</label>
            <input  placeholder="أدخل رصيد المحطة الحالي" type="number" id="OoredooBillsBalance" name="OoredooBillsBalance" required>
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
