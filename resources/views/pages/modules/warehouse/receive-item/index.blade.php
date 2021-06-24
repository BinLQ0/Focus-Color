@extends('_layouts.base')

@section('title', 'Receive Item')

@section('css')
	<link rel="stylesheet" href="{{ URL::asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-2">

        <x-card>
            <x-input daterangepicker name='srcDateStart' label='From Date :' class='dt-reload' />
            <x-input daterangepicker name='srcDateEnd' label='To Date :' class='dt-reload' />
        </x-card>

	</div>

	<div class="col-9">

        <h2> RECEIVE ITEM </h2>

        <div class="row d-flex justify-content-between">

            <div class="col-4">
                <x-button id='btn_create' :url='route("receive.create")' class='bg-success btn-sm' icon='far fa-plus-square' label='Create' />
            </div>

            <div class="col-3">
                <x-input name='search' placeholder='Search' class="form-control-sm search-input" />
            </div>

        </div>

        <x-card theme-mode='outline' theme='primary' component='tables.modules.warehouse.receive-item-table' body-class='p-0' />
    </div>
</div>

@endsection

@section('js')
<script src="{{ url::asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ url::asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ url::asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
@endsection