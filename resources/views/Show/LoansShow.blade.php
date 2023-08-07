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

    <form action="{{ route('LoansShowWithDate.show') }}" method="post">
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

    <h1>سجل الديون ليوم {{$date}} </h1>
    <table dir="rtl">
        <thead>
        <tr>
            <th>الرقم</th>
            <th>نوع العملية</th>
            <th>الصنف</th>
            <th>المبلغ</th>
            <th>الكمية</th>
            <th>إجمالي</th>
            <th>دفعة أولى</th>
            <th>الملاحظات</th>
            <th>اسم الدائن</th>
            <th>وقت التسجيل</th>
            <th>بواسطة المستخدم</th>
            <th>الاجراءات</th>

        </tr>
        </thead>
        <tbody>

        @foreach($Loans as $Loan)
            <tr>

                <th scope="row">{{$Loan -> id}}</th>
                <td>{{ $Loan-> RecordType}}</td>
                <td>{{ $Loan-> item}}</td>
                <td>{{$Loan -> amount}}₪</td>
                <td>{{$Loan -> quantity}}</td>
                <td>{{$Loan -> total}}₪</td>
                <td>{{$Loan -> FirstPay}}₪</td>
                <td>{{$Loan -> notes}}</td>
                <td>{{$Loan -> debtorName}}</td>
                <td>{{$Loan -> created_at}}</td>
                <td>{{$Loan -> UserName}}</td>

                <td style="display: flex " >
                    <a  href="{{route('Loans.edit',$Loan->id)}}" class="btn btn-success">تعديل الصف</a>
                    <a onclick="confirmDelete('{{route('Loans.Delete',$Loan->id)}}')" class="btn btn-danger"> حذف الصف</a>
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
    <div class="text-box">
        <p> : إجمالي ديون اليوم  <p dir="ltr" class="total-sales">  ₪{{ $todayTotal }} </p>
        <a href="{{ route('LendForm') }}" class="btn btn-primary">إضافة جديد</a>

    </div>
</div>
</body>
</html>

@endsection
