@extends('_layouts.base')

@section('title', 'Create Warehouses' )

@section('css')
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">
    
        @if(isset($warehouse))

            {{-- Update Warehouse --}}
            <h2 class="mb-3"> Update Warehouse </h2>

            {{ Form::model($warehouse, ['route' => ['warehouses.update', $warehouse->id], 'method' => 'PUT']) }}
            {{ Form::token() }}

            {{-- ./Update Warehouse --}}
        @else

            {{-- Create Warehouse --}}
            <h2 class="mb-3"> Create Warehouse </h2>

            {{ Form::open(array('route' => 'warehouses.store', 'method' => 'post', 'class' => 'form-horizontal')) }}
            {{ Form::token() }}

            @php
                $warehouse = null;
            @endphp

            {{-- ./Create Warehouse --}}
        @endif

        <x-card>
            <x-input name='name' label='Name' :bind="$warehouse"/>
            <x-textarea name='address' label='Location Address' placeholder="Address Line" rows="3" :bind="$warehouse" />

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
