@extends('_layouts.base')

@section('title', 'Create Job Cost')

@section('css')

<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">

@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-6">

        <h2 class="mb-3"> Create Job Cost </h2>

        {{ Form::open(array('route' => 'jobcost.store', 'method' => 'post', 'class' => 'form-horizontal')) }}
        {{ Form::token() }}

        <x-card>

            <div class="row">
                <div class="col-sm-6">
                    <x-date form='v' name='date' label="Date" />
                </div>
                <div class="col-sm-6">
                    <x-select form='v' name='for' type='text' label='Used For...' :option='$referance' />
                </div>
                <div class="col-sm-12">
                    <x-input form='v' name='description' type='text' label='Note' placeholder='(Optional)' />
                </div>
            </div>
        </x-card>

        <x-card>
            <x-tables.product-list-table header='Product' view-stock=true />
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
