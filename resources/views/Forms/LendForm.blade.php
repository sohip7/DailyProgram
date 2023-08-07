@extends('layouts.app')
@section('content')

<head>
    <title>إضافة دَين جديد</title>
    <link rel="stylesheet" href="{{ asset('css/Forms.css') }}">
</head>
<body>
<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <h1>إضافة دَين جديد</h1>
    <form action="{{route('Lends.store')}}" method="post">
        @csrf

        <div class="custom-select">
            نوع العملية:
            <select id="RecordType" name="RecordType">
                <option value="General" selected>مبيعات عامة </option>
                <option value="Ooredoo">رصيد أوريدوا </option>
                <option value="Jawwal">رصيد جوال </option>
                <option value="OoredooBills">تسديد فاتورة أوريدوا </option>
                <option value="JawwalPay">شحن جوال باي</option>
                <option value="Electricity"> رصيد كهرباء</option>
                <option value="SellDevice"> تقسيط جهاز</option>
                <!-- يمكنك إضافة المزيد من الخيارات هنا -->
            </select>



        </div>

{{--        <script>--}}

{{--            document.getElementById('RecordType').addEventListener('change', function() {--}}
{{--                // احصل على قيمة الـ select المحددة--}}
{{--                var selectedValue = this.value;--}}

{{--                if (selectedValue === 'SellDevice') {--}}
{{--                    document.getElementById('quantity').style.visibility = 'hidden';--}}
{{--                } else {--}}
{{--                    document.getElementById('quantity').style.display = 'block';--}}
{{--                }--}}
{{--            });--}}
{{--        </script>--}}

        <div class="form-group">
            <label for="item_name">اسم الصنف:</label>
            <input  placeholder="أدخل اسم الصنف الذي تم إدانته" type="text" id="item_name" name="item_name" required>
        </div>

        <div class="form-group">
            <label for="amount">المبلغ:</label>
            <input  placeholder="أدخل المبلغ" type="number" id="amount" name="amount" required>
        </div>

        <div  id="quantity" class="form-group">
            <label  for="quantity">الكمية:</label>
            <input type="number" id="quantity" name="quantity" value="1">
        </div>

        <div  id="quantity" class="form-group">
            <label  for="FirstPay">الدفعة الاولى:</label>
            <input type="number" id="FirstPay" name="FirstPay" value="0">
        </div>

        <div class="form-group">
            <label for="debtor_name">اسم المدين:</label>
            <input  placeholder="أدخل الشخص المدين" type="text" id="debtor_name" name="debtor_name" required>
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
