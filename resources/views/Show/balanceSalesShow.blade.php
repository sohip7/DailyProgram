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

    <!-- رابط مكتبة jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- رابط مكتبة daterangepicker -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css">
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

    <form action="{{ route('balanceSalesShowWithDate.show') }}" method="post">
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


    <h1>بيانات الأرصدة المباعة خلال يوم {{ $date }}</h1>
    <table dir="rtl">
        <thead>
        <tr>
            <th>الرقم</th>
            <th>رصيد جوال</th>
            <th>رصيد أوريدوا</th>
            <th>رصيد جوال باي</th>
            <th>رصيد الكهرباء</th>
            <th>رصيد فواتير أوريدوا</th>
            <th>إجمالي الدفعات الأولى</th>
            <th>رصيد بنك فلسطين</th>
            <th>رصيد بنك القدس</th>
            <th>اخر تحديث</th>
        </tr>
        </thead>
        <tbody>
        @foreach($balancsales as $balancsale)
            <tr>

                <th scope="row">{{$balancsale -> id}}</th>
                <td>{{$balancsale-> jawwal}}</td>
                <td>{{$balancsale-> ooredoo}}</td>
                <td>{{$balancsale -> jawwalpay}}</td>
                <td>{{$balancsale -> electricity}}</td>
                <td>{{$balancsale -> ooredoobills}}</td>
                <td>{{$balancsale -> firstpay}}</td>
                <td>{{$balancsale -> bop}}</td>
                <td>{{$balancsale -> bankquds}}</td>
                <td>{{$balancsale -> updated_at}}</td>


            </tr>
        @endforeach

        </tbody>
    </table>

</div>

</body>
</html>

@endsection
