@extends('_layouts.base')

@section('title', 'Relation Company')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">

        <h2 class="mb-3"> Create Relation Company </h2>

        <x-card>
            
            {{ Form::open(array('route' => 'relations.store', 'method' => 'post', 'class' => 'form-horizontal')) }}
            {{ Form::token() }}

            <x-input form='v' name='name' type='text' label='Company Name' />
            <x-textarea form='v' name='address' type='textarea' label='Address' />

            <x-checkbox name='is_supplier' label='Supplier' margin='mb-2' />
            <x-checkbox name='is_customer' label='Customer' margin='mb-2' />

            <div class="text-right">
                <button type="submit" class="btn btn-primary mt-3">Save</button>
            </div>

            {{ Form::close() }}
            
        </x-card>
    </div>
</div>
@endsection

@section('js')
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
@endsection
