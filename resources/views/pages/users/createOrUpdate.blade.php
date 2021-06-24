@extends('_layouts.base')

@section('title', 'User Management')

@section('css')

{{-- Select 2 --}}
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-3">

        @if(isset($user))

            {{-- Update User --}}
            <h2 class="mb-3"> Update User </h2>

            {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) }}
            {{ Form::token() }}

            {{-- ./Update User --}}
        @else

            {{-- Create User --}}
            <h2 class="mb-3"> Create User </h2>

            {{ Form::open(['route' => 'users.store', 'method' => 'post', 'class' => 'form-horizontal']) }}
            {{ Form::token() }}

            {{-- ./Create User --}}
        @endif

        <x-card theme='primary' theme-mode='outline'>

            <x-input name='username' label='Username' :bind='$user ?? null' />
            <x-input name='password' type='password' label='Password' placeholder='******' />
            <x-input name='password_confirmation' type='password' label='Password Confirmation' placeholder='******' />

        </x-card>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

        {{ Form::close() }}

    </div>
</div>
@endsection

@section('js')
{{-- Select 2 --}}
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
@endsection