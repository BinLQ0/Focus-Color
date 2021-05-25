@extends('_layouts.base')

@section('title', 'Create Warehouses' )

@section('css')
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">
    
        <h2 class="mb-3"> Create Warehouse </h2>

        <x-card>

            {{ Form::open(array('route' => 'warehouses.store', 'method' => 'post', 'class' => 'form-horizontal')) }}
            {{ Form::token() }}

            <x-input form='v' name='name' type='text' label='Name' />
            <x-textarea form='v' name='address' type='text' label='Location Address' placeholder="Address Line" />

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
