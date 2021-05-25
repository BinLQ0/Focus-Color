@extends('_layouts.base')

@section('title', 'Product Result')

@section('css')

<!-- Bootstrap 4 -->
<link rel="stylesheet"
    href="{{ URL::asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<!-- Sweet Alert 2 -->
<link rel="stylesheet"
    href="{{ URL::asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}	">
<!-- Date Range Picker -->
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">

<!-- CSRF Token -->
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

        <h2> PRODUCT RESULT </h2>

        <div class="row d-flex justify-content-between">

            <div class="col-4">
                <x-button id='btn_create' :url='url("result/create")' class='bg-success btn-sm'
                    icon='far fa-plus-square' label='Create' />
            </div>

            <div class="col-3">
                <x-input name='search' placeholder='Search' class="form-control-sm search-input" />
            </div>

        </div>

        <x-card component='tables.product-result-table' has-padding='true' />
    </div>
</div>

@endsection

@section('js')
<!-- DataTables -->
<script src="{{ url::asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ url::asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Date Range Picker -->
<script src="{{ url::asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
@endsection