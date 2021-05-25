@extends('_layouts.base')

@section('title', 'Home')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
@endsection

@section('content')
<div class="title m-b-md">
    Hello, {{ Auth::user()->username }}
</div>
@endsection
