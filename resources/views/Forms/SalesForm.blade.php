@extends('layouts.app')
@section('content')

<head>
    <title>إضافة بيع صنف جديد</title>
    <link rel="stylesheet" href="{{ asset('css/Forms.css') }}">
</head>

<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

        @if(Session::has('Error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('Error') }}
        </div>
    @endif
    <h1>إضافة بيع صنف جديد</h1>
        <h6 class="text-danger"> <span style="font-size: 20px" class="required-label"> </span>   تشير إلى أن الحقل مطلوب</h6>

        <form class="form-group" action="{{route('sales.store')}}"  method="post">
        @csrf

        <div class="custom-select">
            نوع العملية:
            <select id="RecordType" name="RecordType" onchange="vh(this.value)" >

                <option value="General" selected>مبيعات عامة </option>
                <option value="OoredooSim" >شريحة أوريدوا </option>
                <option value="Ooredoo" >رصيد أوريدوا </option>
                <option value="Jawwal" >رصيد جوال </option>
                <option value="OoredooBills">تسديد فاتورة أوريدوا </option>
                <option value="JawwalPay">شحن جوال باي</option>
                <option value="Electricity"> رصيد كهرباء</option>
                <!-- يمكنك إضافة المزيد من الخيارات هنا -->
            </select>
        </div>
        <script>
            function vh(value){
                const actP=document.getElementById('actP');
                const item_name=document.getElementById('item_name');
                actP.style.display= value == 'OoredooSim' ? "block" : "none";
                document.getElementById('item_name').value= value=='OoredooSim' ? 'تفعيل شريحة' : '';
            if(value=== "Ooredoo"){
                item_name.value = "رصيد أوريدوا";
            }else if(value=== "Jawwal"){
                item_name.value = "رصيد جوال";
            } else if(value=== "OoredooBills"){
                item_name.value = "فواتير أوريدوا";
            } else if(value=== "JawwalPay"){
                item_name.value = "جوال باي";
            } else if(value=== "Electricity"){
                item_name.value = "رصيد كهرباء";
            }


            }
        </script>


        <div  class="form-group">
            <label for="item_name">اسم الصنف:<span class="required-label"></span></label>
            <input  placeholder="أدخل اسم الصنف الذي تم بيعه" type="text" id="item_name" name="item_name" required>
        </div>

        <div class="form-group">
            <label for="amount">المبلغ:<span class="required-label"></span></label>
            <input  placeholder="أدخل المبلغ" onchange="vi()" type="number" id="amount" name="amount" required>
        </div>

        <div id="test" class="form-group">
            <label for="quantity">الكمية:<span class="required-label"></span></label>
            <input type="number" id="quantity" name="quantity" value="1">
        </div>

        <div id="actP" class="form-group" style="display: none" >
            <label for="ActivePrice">رسوم التفعيل:<span  id="RL" class="required-label"></span></label>
            <input type="number" id="ActivePrice" name="ActivePrice" value="1">
        </div>

        <div class="form-group">
            <label for="notes">ملاحظات:</label>
            <textarea  placeholder="اكتب ملاحظات إذا كان هناك أي ارشادات " id="notes" name="notes"></textarea>
        </div>
        <label class="label" for="UserConfirm">
            هل أنت {{$user_data->name}}
            <input  id="UserConfirm" type="checkbox" required>
        </label>

        <button type="submit" >إضافة</button>
    </form>
{{--        <a href="{{ route('sales.show') }}" class="btn btn-primary">عرض حركات تسجيل الأصناف اليوم</a>--}}
        <script>


            function vi() {
                const inputValue = document.getElementById("amount").value;
                const errorMessage = document.getElementById("error-message");

                if (inputValue < 0) {
                    showErrorMessage('انتبه! انت تدخل قيمة سالبة')
                } else {
                    errorMessage.textContent = "";
                }
            }


            function showErrorMessage(message) {
                const errorMessage = document.getElementById("error-message");
                errorMessage.textContent = message;
                errorMessage.style.display = "block";

                setTimeout(() => {
                    errorMessage.style.display = "none";
                }, 7000); // Hide after 3 seconds (adjust as needed)
            }



        </script>


</div>



@endsection
