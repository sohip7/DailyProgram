@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html>
<head>
    <title>جدول بيانات</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Show.css') }}">
</head>
<body>
<div class="container">
    <h1>سجل أرصدة المحطات الافتتاحي ليوم {{ Now()->format('Y-m-d') }}</h1>
    <table dir="rtl">
        <thead>
        <tr>
            <th>الرقم</th>
            <th>نوع الأرصدة</th>
            <th>رصيد أوريدوا</th>
            <th>رصيد جوال</th>
            <th>رصيد جوال باي</th>
            <th>رصيد الكهرباء</th>
            <th>رصيد فواتير أوريدوا</th>
            <th>ملاحظات</th>
            <th>وقت التسجيل</th>
            <th>بواسطة المستخدم</th>
            <th>الاجراءات</th>
        </tr>
        </thead>
        <tbody>
        @foreach($PlatsBalance as $PtsBal)
            <tr>

                <th scope="row">{{$PtsBal -> id}}</th>
                <td>{{$PtsBal-> BalanceType}}</td>
                <td>{{$PtsBal-> OoredooBalance}}</td>
                <td>{{$PtsBal -> JawwalBalance}}</td>
                <td>{{$PtsBal -> JawwalPayBalance}}</td>
                <td>{{$PtsBal -> ElectricityBalance}}</td>
                <td>{{$PtsBal -> OoredooBillsBalance}}</td>
                <td>{{$PtsBal -> notes}}</td>
                <td>{{$PtsBal -> created_at}}</td>
                <td>{{$PtsBal -> userName}}</td>




                <!--   <td><img  style="width: 90px; height: 90px;" src=""></td>-->

                <td style="display: flex ; " >
                    <a href="" class="btn btn-success">تعديل الصف</a>
                    <a href="" class="btn btn-danger"> حذف الصف</a>
                </td>




            </tr>
        @endforeach


        </tbody>
    </table>
    <div class="container1">
        <button  type="button" class="bf btn btn-primary">
            فارق رصيد أوريدوا <span  style="font-size: 25px" class="badge badge-light">{{ $OoredooBalanceEnd }}</span>
        </button>

        <button  type="button" class="bf btn btn-primary">
            فارق رصيد جوال <span  style="font-size: 25px" class="badge badge-light">{{ $JawwalBalanceEnd }}</span>
        </button>

        <button  type="button" class="bf btn btn-primary">
            فارق رصيد جوال باي <span  style="font-size: 25px" class="badge badge-light">{{ $JawwalPayBalanceEnd }}</span>
        </button>

        <button  type="button" class="bf btn btn-primary">
            فارق رصيد الكهرباء <span  style="font-size: 25px" class="badge badge-light">{{ $ElectricityBalanceEnd }}</span>
        </button>

        <button  type="button" class="bf btn btn-primary">
            فارق رصيد فواتير اوريدوا <span  style="font-size: 25px" class="badge badge-light">{{ $OoredooBillsBalanceEnd }}</span>
        </button>



    </div>
</div>

</body>
</html>

@endsection
