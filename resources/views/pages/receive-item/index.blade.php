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

        <x-card header='FILTER'>
            <x-date form='v' id='srcDateStart' name='srcDateStart' label='From' class='form-control-sm' />
            <x-date form='v' id='srcDateEnd' name='srcDateEnd' label='To' class='form-control-sm' />
        </x-card>

	</div>

	<div class="col-9">

        <h2> RECEIVE ITEM </h2>

        <div class="row d-flex justify-content-between">

            <div class="col-4">
                <x-button id='btn_create' :url='url("receive/create")' class='bg-success btn-sm'
                    icon='far fa-plus-square' label='Create' />
            </div>

            <div class="col-3">
                <x-input name='search' placeholder='Search' class="form-control-sm search-input" />
            </div>

        </div>

        <x-card component='tables.receive-item-table' has-padding='true' />
    </div>
</div>

@endsection

@section('js')
<script src="{{ url::asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ url::asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ url::asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
@endsection