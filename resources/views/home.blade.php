@extends('layouts.app')
{{--route('SalesForm'--}}
@section('content')

    <div  class="greeting">
        <div dir="ltr" style="display: inline" class="text-success">
            {{  explode(' ', $user_data->name)[0] }}
        </div>
        <script>
            const currentHour = new Date().getHours();

            if (currentHour >= 0 && currentHour < 12) {
                document.write("صباح الخير ");
            } else {
                document.write("مساء الخير ");
            }
        </script>

    </div>


        <link rel="stylesheet" type="text/css" href="{{asset('css/Home.css')}}">


    <div class="container">
        @if(Session::has('v'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('v') }}
            </div>
        @endif
        <h1>قائمة العمليات</h1>
        <div style=" align-content: center" class="button-list">
            <a href="{{route('SalesForm')}}" class="btn">إدخال المبيعات اليومية </a>
            <a href="{{route('OutsForm')}}" class="btn">إدخال مًخرج جديد</a>
            <a href="{{route('CustomersPaymentForm')}}" class="btn">إدخال دفعة من زبون </a>
            <a href="{{route('LendForm')}}" class="btn">إدخال دَين جديد</a>
            <a href="{{route('DealersBuyForm')}}" class="btn">إدخال مشتريات </a>
            <a  href="{{route('PlatformBalanceForm')}}" class="btn">إدخال أرصدة محطات الشحن </a>
            <a  href="{{route('payToMerchantForm')}}" class="btn">إدخال دفعة إلكترونية إلى تاجر  </a>
            <a  href="{{route('DailyNotesForm')}}" class="btn">إدخال ملاحظة عامة لليومية  </a>



        </div>
    </div>

</div>
@endsection
