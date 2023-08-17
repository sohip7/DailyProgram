<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', ' إدخال المبيعات') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body >
        <div id="app" >

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand center" href="{{ url('/home') }}">
                    MC-SYSTEM V0.1B
                </a>
                <div style="flex: 0%;"></div>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="test">
                    <span class="navbar-toggler-icon"></span>
                </button>


                    <!-- Left Side Of Navbar -->

                <div  class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <!-- Left Side Of Navbar -->

                        <!-- قائمة المنسدلة -->
                        <li class="nav-item dropdown">
                            <a  class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                قائمة العمليات
                            </a>

                            <div style="text-align: center" class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a  class="dropdown-item" href="{{ url('DailyForms/SalesForm') }}">إدخال مبيعات جديدة</a>
                                <a  class="dropdown-item" href="{{ url('DailyForms/CustomersPaymentForm') }}">إدخال دفعات جديدة من زبائن</a>
                                <a  class="dropdown-item" href="{{ url('DailyForms/OutForm') }}">إدخال مخرجات جديدة</a>
                                <a  class="dropdown-item" href="{{ url('DailyForms/LendForm') }}">إدخال دَين جديد</a>
                                <a  class="dropdown-item" href="{{ url('DailyForms/DealersBuyForm') }}">إدخال مشتريات جديد</a>
                                <a  class="dropdown-item" href="{{ url('DailyForms/PlatformBalance') }}">إدخال رصيد المحطات </a>
                                <a  class="dropdown-item" href="{{ route('DailyNotesForm') }}">إدخال ملاحظات لليومية </a>
                                <a  class="dropdown-item" href="{{ route('payToMerchantForm') }}">دفع إلى تاجر </a>
                                <!-- إضافة المزيد من الروابط حسب الحاجة -->
                            </div>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <!-- Left Side Of Navbar -->
                        <!-- قائمة المنسدلة -->
                        <li class="nav-item dropdown">
                            <a  class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                عرض حركات التسجيل
                            </a>
                            <div style="text-align: center" class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a  class="dropdown-item" href="{{ route('sales.show') }}">عرض حركات تسجيل مبيعات "أصناف"</a>
                                <a  class="dropdown-item" href="{{ route('CustomerPay.show') }}">عرض حركات تسجيل دفعات الزبائن </a>
                                <a  class="dropdown-item" href="{{ route('Loans.show') }}">عرض حركات تسجيل الديون الجديدة </a>
                                <a  class="dropdown-item" href="{{ route('Outs.show') }}">عرض حركات تسجيل المخرجات "المصروفات"</a>
                                <a  class="dropdown-item" href="{{ route('Purchases.show') }}">عرض حركات تسجيل مشتريات</a>
                                <a  class="dropdown-item" href="{{ route('PayMerchant.show') }}">عرض حركات دفع لتجار الكتروني</a>
                                <a  class="dropdown-item" href="{{ route('PlatformBalance.show') }}">عرض أرصدة منصات الشحن المسجلة</a>
                                <a  class="dropdown-item" href="{{ route('BalanceSales.show') }}">عرض مبيعات الرصيد</a>
                                <a  class="dropdown-item" href="{{ route('DailySummary.show') }}">عرض ملخص اليومية </a>
                                <a  class="dropdown-item" href="{{ route('DailyNotes.show') }}">عرض ملاحظات اليومية </a>


                                <!-- إضافة المزيد من الروابط حسب الحاجة -->
                            </div>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">تسجيل دخول</a>
                                </li>
                            @endif

{{--                            @if (Route::has('register'))--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="{{ route('register') }}">تسجيل مستخدم جديد</a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        تسحيل خروج
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
{{--footer--}}
<footer class="bg-light text-center text-lg-start">
    <!-- Copyright -->
    <div class="text-center p-1" style="background-color: rgba(0, 0, 0, 0.2);">
      MC-System  &copy;{{ now()->year }} Copyright
    </div>

    <!-- Copyright -->
</footer>
<!-- End of .container -->

</html>
