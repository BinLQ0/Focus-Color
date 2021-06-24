@extends('_layouts.base')

@section('title', 'Create Delivery')

@section('css')

<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">

@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-6">

        @if(isset($delivery))

            {{-- Update Delivery Order --}}
            <h2 class="mb-3"> Update Delivery Order </h2>

            {{ Form::model($delivery, ['route' => ['delivery.update', $delivery->id], 'method' => 'PUT']) }}
            {{ Form::token() }}

            {{-- ./Update Delivery Order --}}
        @else

            {{-- Create Delivery Order --}}
            <h2 class="mb-3"> Create Delivery Order </h2>

            {{ Form::open(array('route' => 'delivery.store', 'method' => 'post', 'class' => 'form-horizontal')) }}
            {{ Form::token() }}

            @php
                $delivery = null;
            @endphp

            {{-- ./Create Delivery Order --}}
        @endif

        <x-card>

            <div class="row">
                <div class="col-6">
                    <x-input daterangepicker name='date' label="Delivery Date" :bind='$delivery'/>
                </div>
                <div class="col-6">
                    <x-input name='for' label='No. Delivery Order' :bind='$delivery'/>
                </div>
                <div class="col-12">
                    <x-select name='description' label='Customer' :option='$customer' :bind='$delivery' />
                </div>
            </div>

        </x-card>

        <x-card theme-mode='outline' theme='primary' body-class='p-0'>
            <x-tables.product-list-table header='Product' :products='optional($delivery)->products' />
        </x-card>

        <div class="text-right">
            <button type="submit" class="btn btn-primary mt-3">Save</button>
        </div>

        {{ Form::close() }}
    </div>
</div>
@endsection

@section('js')
<script src="{{ url::asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ url::asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ url::asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ url::asset('plugins/datatables/jquery.dataTables.js') }}"></script>
@endsection
