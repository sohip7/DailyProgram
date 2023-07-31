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

    <div class="container">

        <!-- رابط مكتبة jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- رابط مكتبة daterangepicker -->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css">
        <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

        <form action="{{ route('CustomerPayWithDate.show') }}" method="post">
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

        <h1>سجل دفعات من الزبائن ليوم {{$date}}</h1>
        <table dir="rtl">
            <thead>
            <tr>
                <th>الرقم</th>
                <th>اسم الشخص</th>
                <th>المبلغ</th>
                <th>الملاحظات</th>
                <th>وقت التسجيل</th>
                <th>بواسطة المستخدم</th>
            </tr>
            </thead>
            <tbody>
            @foreach($CusPays as $CusPay)
                <tr>

                    <th scope="row">{{$CusPay -> id}}</th>
                    <td>{{ $CusPay-> CustomerName}}</td>
                    <td>{{$CusPay -> amount}}₪</td>
                    <td>{{$CusPay -> notes}}</td>
                    <td>{{$CusPay -> created_at}}</td>
                    <td>{{$CusPay -> userName}}</td>


                    <!--<td>
{{--                    <a href="{{url('offers/edit/'.$offer -> id)}}" class="btn btn-success"> {{__('messages.update')}}</a>--}}
                    {{--                    <a href="{{route('offers.delete',$offer -> id)}}" class="btn btn-danger"> {{__('messages.delete')}}</a>--}}
                    </td>-->

                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-box">
            <p> إجمالي مبيعات اليومية "أصناف" هو  <p dir="ltr" class="total-sales">  ₪{{ $todayTotal }} </p>
        </div>
    </div>
</div>
</body>
</html>

@endsection
