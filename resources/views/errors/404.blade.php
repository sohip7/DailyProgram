@extends('errors.layout')

@php
  $error_number = 404;
@endphp

@section('title')
  العملية لم تنفذ
@endsection

@section('description')
  @php
    $default_error_message = "وصول غير مصرح به، إذا كنت تعتقد أن هذا خطأ، قم بالتواصل مع صهيب";
  @endphp
  {!! isset($exception)? ($exception->getMessage()?e($exception->getMessage()):$default_error_message): $default_error_message !!}
@endsection
