@extends('layouts.app')
@section('content')

<head>
    <title>إضافة ملاحظة جديدة</title>
    <link rel="stylesheet" href="{{ asset('css/Forms.css') }}">
</head>
<body>
<div class="container">
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <h1>إضافة ملاحظة جديدة</h1>
    <form action="{{route('notes.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="notes">الملاحظة:</label>
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
