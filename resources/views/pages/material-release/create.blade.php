@extends('_layouts.base')

@section('title', 'Create Release Material')

@section('css')

<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">

@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-6">

        <h2 class="mb-3"> Create Release Material </h2>

        {{ Form::open(array('route' => 'release.store', 'method' => 'post', 'class' => 'form-horizontal')) }}
        {{ Form::token() }}

        <x-card>

            <div class="row">
                <div class="col-6">
                    <x-date form='v' name='date' label="Release Date" />
                </div>
                <div class="col-6">
                    <x-input form='v' name='for' label='No. Lot' />
                </div>
                <div class="col-12">
                    <x-select form='v' name='description' label='Product' :option='$finish_good' />
                </div>
            </div>

        </x-card>

        <x-card>
            <x-tables.product-list-table header='Material' option='is_material' view-stock=true />
        </x-card>

        <div class="row">
            <div class="col-8 align-items-center" style="font-size: 24px;">
                <label for="total">Material Weight : 0 Kg</label>
            </div>
            <div class="col-4 text-right">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>

        {{ Form::close() }}
    </div>
</div>
@endsection

@section('js')
<!-- SweetAlert2 -->
<script src="{{ url::asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Datepicker Script -->
<script src="{{ url::asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Select2 Script -->
<script src="{{ url::asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Datatable Script -->
<script src="{{ url::asset('plugins/datatables/jquery.dataTables.js') }}"></script>
@endsection