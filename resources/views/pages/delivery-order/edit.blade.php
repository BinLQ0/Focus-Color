@extends('_layouts.base')

@section('title', 'Edit Delivery Order')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-6">

        <h2 class="mb-3"> Edit Delivery Order </h2>

        {{ Form::model($delivery, ['route' => ['delivery.update', $delivery->id], 'method' => 'PUT']) }}
        {{ Form::token() }}

        <x-card>
            <div class="row">
                <div class="col-6">
                    <x-date form='v' name='date' label="Delivery Date" :value='$delivery->shortDate' />
                </div>
                <div class="col-6">
                    <x-input form='v' name='for' label='No. Delivery Order' :value='$delivery->for' />
                </div>
                <div class="col-12">
                    <x-select form='v' name='description' label='Customer' :option='$customer' :selected='[$delivery->description]' />
                </div>
            </div>
        </x-card>

        <x-card>
            <x-tables.product-list-table header='Product' option='is_goods' :products='$delivery->products' view-stock=true />
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
