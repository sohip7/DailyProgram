@extends('layouts.app')
@section('content')

<head>
    <title>تعديل أرصدة المحطات</title>
    <link rel="stylesheet" href="{{ asset('css/Forms.css') }}">
</head>
<body>
<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <h1>تعديل أرصدة محطات الشحن</h1>
    <form action="{{route('PlatformBalance.Update',$PlatformBalances->id)}}" method="post">
        @csrf



        <div class="form-group">
            <label for="BalanceType"> نوع الإدخال</label>
            <select id="BalanceType" name="BalanceType" required >
                <option @if($PlatformBalances->BalanceType === 'افتتاحي') selected @endif value="افتتاحي">افتتاحي</option>
                <option @if($PlatformBalances->BalanceType === 'نهائي') selected @endif value="نهائي">نهائي</option>
            </select>
        </div>

        <div class="form-group">
            <label for="OoredooBalance">رصيد أوريدوا:</label>
            <input  placeholder="أدخل رصيد المحطة الحالي" type="number" id="OoredooBalance" name="OoredooBalance" required value="{{$PlatformBalances->OoredooBalance}}">
        </div>

        <div class="form-group">
            <label for="JawwalBalance">رصيد جوال:</label>
            <input  placeholder="أدخل رصيد المحطة الحالي" type="number" id="JawwalBalance" name="JawwalBalance" required value="{{$PlatformBalances->JawwalBalance}}">
        </div>

        <div class="form-group">
            <label for="JawwalPayBalance">رصيد جوال باي:</label>
            <input  placeholder="أدخل رصيد المحطة الحالي" type="number" id="JawwalPayBalance" name="JawwalPayBalance" required value="{{$PlatformBalances->JawwalPayBalance}}">
        </div>

        <div class="form-group">
            <label for="ElectricityBalance">رصيد الكهرباء:</label>
            <input  placeholder="أدخل إجمالي رصيد الديكسين والعادي" type="number" id="ElectricityBalance" name="ElectricityBalance" required value="{{$PlatformBalances->ElectricityBalance}}">
        </div>

        <div class="form-group">
            <label for="OoredooBillsBalance">رصيد أوريدوا الفواتير:</label>
            <input  placeholder="أدخل رصيد المحطة الحالي" type="number" id="OoredooBillsBalance" name="OoredooBillsBalance" required value="{{$PlatformBalances->OoredooBillsBalance}}">
        </div>


        <div class="form-group">
            <label for="BankOfPalestineBalance">رصيد بنك فلسطين :</label>
            <input  placeholder="أدخل رصيد المحطة الحالي" type="number" id="BankOfPalestineBalance" name="BankOfPalestineBalance" required value="{{$PlatformBalances->BankOfPalestineBalance}}">
        </div>


        <div class="form-group">
            <label for="BankAlQudsBalance">رصيد بنك القدس:</label>
            <input  placeholder="أدخل رصيد المحطة الحالي" type="number" id="BankAlQudsBalance" name="BankAlQudsBalance" required value="{{$PlatformBalances->BankAlQudsBalance}}">
        </div>



        <div class="form-group">
            <label for="notes">ملاحظات:</label>
            <textarea placeholder="ملاحظات" type="text" id="notes" name="notes" > {{$PlatformBalances->notes}}</textarea>
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
