@extends('layouts.app')
@section('content')
{{--    <style>--}}
{{--    @font-face {--}}
{{--    font-family: "Your_custom_font_name";--}}
{{--    src: url("../fonts/Amiri-Regular.ttf") format('truetype');--}}
{{--    font-weight: normal;--}}
{{--    font-style: normal;--}}
{{--    }--}}

{{--    @font-face {--}}
{{--    font-family: "Your_custom_font_name";--}}
{{--    src: url("../fonts/Amiri-Bold.ttf") format('truetype');--}}
{{--    font-weight: bold;--}}
{{--    font-style: normal;--}}
{{--    }--}}
{{--    </style>--}}
    <h1 style="direction: rtl; text-align: center;">بيانات اليومية النهائية ليوم </h1>

    <a href="{{ route('DailyData.print') }}">
        <button style="margin-left: 45%" class="btn btn-info" type="button">طباعة اليومية</button>
    </a>

    <div style=" direction: rtl; display: flex; flex-wrap: wrap; padding-top: 50px; justify-content: space-between; text-align: center " class="container">

    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header">رصيد أوريدوا النهائي </div>
        <div class="card-body">
            <h5 class="card-title text-info">{{$OoredooEnd}} شيكل</h5>
            <p class="card-text"> التفاصيل: <br>
                  الرصيد الافتتاحي : {{ $openbalance->OoredooBalance }} <br>
                 الرصيد المشترى : {{ $TotalOoredooBuyDealer }} <br>
                 الرصيد المباع: {{ $balancsales->ooredoo }}
             <br>  ديون أرصدة أوريدوا:    {{ $totalOoredooLoan }}
            </p>
        </div>
    </div>
    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header">رصيد جوال النهائي</div>
        <div class="card-body">
            <h5 class="card-title text-info">{{$JawwalEnd}} شيكل </h5>
            <p class="card-text"> التفاصيل: <br>
                الرصيد الافتتاحي : {{ $openbalance->JawwalBalance }} <br>
                الرصيد المشترى : {{ $TotalJawwalBuyDealer }} <br>
                الرصيد المباع: {{ $balancsales->jawwal }}
                <br>  ديون أرصدة جوال:    {{ $totalJawwalLoan }}
            </p>
        </div>
    </div>
    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header">رصبد جوال باي النهائي</div>
        <div class="card-body">
            <h5 class="card-title text-info">{{$JawwalpayEnd}} شيكل</h5>
            <p class="card-text"> التفاصيل: <br>
                الرصيد الافتتاحي : {{ $openbalance->JawwalPayBalance }} <br>
                الرصيد المشترى : {{ $TotalJawwalPayBuyDealer }} <br>
                الرصيد المباع: {{ $balancsales->jawwalpay }}
                <br>  ديون أرصدة جوال باي:    {{ $totalJawwalPayLoan }}
            </p>
        </div>
    </div>
    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header">رصيد فواتير أوريدوا النهائي</div>
        <div class="card-body">
            <h5 class="card-title text-info">{{$OoredooBillsEnd}} شيكل </h5>
            <p class="card-text"> التفاصيل: <br>
                الرصيد الافتتاحي : {{ $openbalance->OoredooBillsBalance }} <br>
                الرصيد المشترى : {{ $TotalOoredooBillsBuyDealer }} <br>
                الرصيد المباع: {{ $balancsales->ooredoobills }}
                <br>  ديون فواتير أوريدوا:    {{ $totalOoredooBillsLoan }}
            </p>
        </div>
    </div>
    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header">رصيد الكهرباء النهائي</div>
        <div class="card-body">
            <h5  class="card-title text-info ">{{$ElectricityEnd}} شيكل </h5>
            <p class="card-text"> التفاصيل: <br>
                الرصيد الافتتاحي : {{ $openbalance->ElectricityBalance }} <br>
                الرصيد المشترى : {{ $TotalElectricityBuyDealer }} <br>
                الرصيد المباع: {{ $balancsales->electricity }}
                <br>  ديون أرصدة الكهرباء:    {{ $totalElectricityLoan }}
            </p>
        </div>
    </div>
    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header">رصيد بنك فلسطين النهائي</div>
        <div class="card-body">
            <h5 class="card-title text-info">{{$BopEnd}} شيكل </h5>
            <p class="card-text">التفاصيل: <br>
                الرصيد الافتتاحي : {{ $openbalance->BankOfPalestineBalance }}<br>
                الرصيد المُخرج: {{ $balancsales->bop }}
            </p>
        </div>
    </div>
    <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
        <div class="card-header">رصيد بنك القدس</div>
        <div class="card-body ">
            <h5 class="card-title text-info">{{$BankQudsEnd}} شيكل </h5>
            <p class="card-text">التفاصيل: <br>
                الرصيد الافتتاحي : {{ $openbalance->BankAlQudsBalance }}<br>
                الرصيد المُخرج: {{ $balancsales->bankquds }}
            </p>
        </div>
    </div>


</div>
    <hr >
    <div style="text-align: center ;">
    <div class="card text-white bg-secondary mb-3" style=" margin-left: 40%; direction: rtl; max-width: 18rem;">
        <div class="card-header">المُدخل</div>
        <div class="card-body">
            <h5 class="card-title text-warning">{{$dailyEntireTotal}} شيكل </h5>
            <p class="card-text">هنا يظهر لك إجمالي المدخلات</p>
        </div>
    </div>
        <h1>-</h1>
    <div class="card text-white bg-secondary mb-3" style=" margin-left: 40%; direction: rtl; max-width: 18rem;">
        <div class="card-header">الخارج</div>
        <div class="card-body">
            <h5 class="card-title text-warning">{{$OutsTotal}} شيكل </h5>
            <p class="card-text">هنا يظهر لك إجمالي المخرجات</p>
        </div>
    </div>
        <h1>=</h1>

    <div  class="card text-white bg-primary mb-3" style=" margin-left: 40%; direction: rtl; max-width: 18rem;">
        <div class="card-header">الرصيد النهائي</div>
        <div class="card-body">
            <h5 class="card-title ">{{$finalBalance}} شيكل </h5>
            <p class="card-text">هنا يظهر لك الرصيد بعد طرح الخارج من المُدخل</p>
        </div>
    </div>
    </div>


@endsection
