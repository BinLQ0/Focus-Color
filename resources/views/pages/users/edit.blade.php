@extends('_layouts.base')

@section('title', 'User Edit')

@section('css')
<!-- Select 2 -->
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">

        <h2 class="mb-3"> User User </h2>

        <x-card>
            <x-input form='v' name='username' type='text' label='Username' :value='$user->username' disabled />
        </x-card>

        {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) }}
        {{ Form::token() }}

        <x-card>
            <x-input form='v' name='password' type='password' label='Password' placeholder='******' />
            <x-input form='v' name='password_confirmation' type='password' label='Password Confirmation'
                placeholder='******' />
        </x-card>
        
        <div class="text-right">
            <button type="submit" class="btn btn-primary mt-3">Save</button>
        </div>

        {{ Form::close() }}
    </div>
</div>

@endsection

@section('js')
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
