@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
<html>
<head>
    <title>جدول بيانات مبيعات اليومية</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Show.css') }}">
</head>
<body>

<div class="container">


    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <!-- رابط مكتبة jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- رابط مكتبة daterangepicker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css">
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

    <form action="{{ route('SalesShow.apply.dates') }}" method="post">
        @csrf
        <div class="date-range-container">
            <button class="apply-dates-btn" type="submit">تطبيق التواريخ</button>

            <input type="text" id="date" name="date" value="{{$date}}" placeholder="من" readonly>

            <div class="date-label">
                <label for="date-from"> :حدد اليوم </label>
            </div>



        </div>
    </form>

    <script>
        $(function() {
            // تفعيل مربع اختيار التاريخ "من"
            $('#date').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'YYYY-MM-DD',
                    applyLabel: 'تطبيق',
                    cancelLabel: 'إلغاء',
                }
            });

        });
    </script>

    <h1>سجل المبيعات اليومية {{$date}} </h1>
    <table dir="rtl">
        <thead>
        <tr>
            <th>الرقم</th>
            <th>نوع العملية</th>
            <th>الصنف</th>
            <th>المبلغ</th>
            <th>الكمية</th>
            <th>إجمالي</th>
            <th>الملاحظات</th>
            <th>وقت التسجيل</th>
            <th>بواسطة المستخدم</th>
            <th>الاجراءات</th>

        </tr>
        </thead>
        <tbody>

        @foreach($sales as $sale)
            <tr>

                <th scope="row">{{$sale -> id}}</th>
                <td>{{ $sale-> RecordType}}</td>
                <td>{{ $sale-> item}}</td>
                <td>{{$sale -> amount}}₪</td>
                <td>{{$sale -> quantity}}</td>
                <td>{{$sale -> total }}₪</td>
                <td>{{$sale -> notes}}</td>
                <td>{{$sale -> created_at}}</td>
                <td>{{$sale -> user_name}}</td>

                <!--   <td><img  style="width: 90px; height: 90px;" src=""></td>-->

                <td style="display: flex ; " >
                    <a href="{{route('sales.edit',$sale->id)}}" class="btn btn-success">تعديل الصف</a>
                    <a onclick="confirmDelete('{{route('Sales.Delete',$sale->id)}}')" class="btn btn-danger"> حذف الصف</a>
                </td>

            </tr>
        @endforeach

        <script>
            function confirmDelete(deleteUrl) {
                if (confirm("هل أنت متأكد من رغبتك في حذف الصف؟")) {
                    window.location.href = deleteUrl;
                } else {
                }
            }
        </script>

        </tbody>
    </table>
    <div  class="text-box">
        <p> إجمالي مبيعات اليومية "أصناف" هو  <p dir="ltr" class="total-sales">  ₪{{ $todayTotal }} </p>
        <a href="{{ route('SalesForm') }}" class="btn btn-primary">إضافة جديد</a>
    </div>


</div>
</body>
</html>

@endsection
