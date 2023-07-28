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
    <h1>سجل المبيعات اليومية ليوم {{ Now()->format('Y-m-d') }}</h1>
    <table dir="rtl">
        <thead>
        <tr>
            <th>الرقم</th>
            <th>الاسم</th>
            <th>البريد الإلكتروني</th>
            <th>العمر</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>أحمد</td>
            <td>ahmed@example.com</td>
            <td>30</td>
        </tr>
        <tr>
            <td>2</td>
            <td>سارة</td>
            <td>sarah@example.com</td>
            <td>25</td>
        </tr>
        <tr>
            <td>3</td>
            <td>محمد</td>
            <td>mohammed@example.com</td>
            <td>28</td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>

@endsection
