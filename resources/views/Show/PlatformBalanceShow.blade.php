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

    <form action="{{ route('PlatformBalanceShowWithDate.show') }}" method="post">
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

    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

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
            <th>رصيد بنك فلسطين</th>
            <th>رصيد بنك القدس</th>
            <th>ملاحظات</th>
            <th>وقت التسجيل</th>
            <th>بواسطة المستخدم</th>
            <th>الاجراءات</th>
        </tr>
        </thead>
        <tbody >
        @foreach($PlatsBalance as $PtsBal)
            <tr>

                <th scope="row">{{$PtsBal -> id}}</th>
                <td>{{$PtsBal-> BalanceType}}</td>
                <td>{{$PtsBal-> OoredooBalance}}</td>
                <td>{{$PtsBal -> JawwalBalance}}</td>
                <td>{{$PtsBal -> JawwalPayBalance}}</td>
                <td>{{$PtsBal -> ElectricityBalance}}</td>
                <td>{{$PtsBal -> OoredooBillsBalance}}</td>
                <td>{{$PtsBal -> BankOfPalestineBalance}}</td>
                <td>{{$PtsBal -> BankAlQudsBalance}}</td>
                <td>{{$PtsBal -> notes}}</td>
                <td>{{$PtsBal -> created_at}}</td>
                <td>{{$PtsBal -> userName}}</td>





                <td  >
                    <a href="{{route('PlatformBalance.edit',$PtsBal->id)}}" class="btn btn-success">تعديل الصف</a>
                    <a onclick="confirmDelete('{{route('PlatformBalance.Delete',$PtsBal->id)}}')" class="btn btn-danger"> حذف الصف</a>
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

        <button  type="button" class="bf btn btn-primary">
            فارق رصيد بنك فلسطين <span  style="font-size: 25px" class="badge badge-light">{{ $BankOfPalestineBalanceEnd }}</span>
        </button>

        <button  type="button" class="bf btn btn-primary">
            فارق رصيد بنك القدس <span  style="font-size: 25px" class="badge badge-light">{{ $BankAlQudsBalanceEnd }}</span>
        </button>



    </div>
</div>

</body>
</html>

@endsection
