@extends('_layouts.base')

@section('title', 'Data Stocktaking')

@section('css')

<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">

@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">

        <h2 class="mb-3"> Stocktaking </h2>

        {{ Form::open(array('route' => 'api.stocktaking.export', 'method' => 'post', 'class' => 'form-horizontal')) }}
        {{ Form::token() }}

        <x-card theme-mode='outline' theme='primary'>

            <div class="row">
                <div class="col-12">
                    <x-input daterangepicker name='date' label="Cut off Date" />
                </div>
            </div>

        </x-card>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Download</button>
        </div>

        {{ Form::close() }}

        <h2 class="mb-3"> Import Stocktaking </h2>

        {{ Form::open(array('route' => 'api.stocktaking.import', 'method' => 'post', 'class' => 'form-horizontal', 'files' => true)) }}
        {{ Form::token() }}

        <x-card theme-mode='outline' theme='primary'>

            <div class="row">
                <div class="col-12">
                    <x-input daterangepicker name='dateImport' label="Adjustment Date" />
                    <x-input name='file' type='file' class='form-control-plaintext align-center' label="Excel File to Upload" />
                </div>
            </div>

        </x-card>

        <div class="text-right">
            <button type="submit" class="btn btn-warning">Upload</button>
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
