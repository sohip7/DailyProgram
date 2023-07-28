@extends('layouts.app')
{{--route('SalesForm'--}}
@section('content')
<div class="container">
    <!DOCTYPE html>
    <html>
    <head>
        <title>قائمة العمليات</title>
        <link rel="stylesheet" type="text/css" href="{{asset('css/Home.css')}}">
    </head>
    <body>
    <div class="container">
        <h1>قائمة العمليات</h1>
        <div class="button-list">
            <a href="{{url('DailyForms\SalesForm')}}" class="btn">إدخال المبيعات اليومية </a>
            <a href="{{url('DailyForms\OutForm')}}" class="btn">إدخال مًخرج جديد</a>
            <a href="{{url('DailyForms\CustomersPaymentForm')}}" class="btn">إدخال دفعة من زبون </a>
            <a href="{{url('DailyForms\LendForm')}}" class="btn">إدخال دَين جديد</a>
            <a href="{{url('DailyForms\DealersBuyForm')}}" class="btn">إدخال مشتريات </a>



        </div>
    </div>
    </body>
    </html>

</div>
@endsection
