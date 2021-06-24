@extends('_layouts.base')

@section('title', 'History')

@section('css')
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{ URL::asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- Date Rangepicker CSS -->
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')

<div class="row">
    <div class="col-2">
        <x-card>
            <x-input daterangepicker id='srcDateStart' name='srcDateStart' label='Date From' class='date-search form-control-sm' />
            <x-input daterangepicker id='srcDateEnd' name='srcDateEnd' label='Date To' class='date-search form-control-sm' />
        </x-card>

        <x-card title='LOCATION' theme-mode='outline' theme='primary'>
            @foreach($product->uniqueOf('racks') as $rack)
                <div class="row border-bottom align-center mt-1">
                    <div class="col-6">
                        <label>{{ $rack->code.' ('.$rack->warehouse->name.')' }}</label>
                    </div>
                    <div class="col-6 text-right">
                        <label>{{ $rack->getQuantity($rack->history) }} Kg</label>
                    </div>
                </div>
            @endforeach
        </x-card>
    </div>
    <div class="col-10">
        <h2><b>{{ $product->name }}</b> <span>( {{ $product->description }} )</span></h2>

        <x-card theme-mode='outline' theme='primary' class="p-0">
            <x-tables.history-table :params='$product' />
        </x-card>
    </div>
</div>

@endsection

@section('js')
<!-- DataTables -->
<script src="{{ url::asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<!-- Date Rangepicker -->
<script src="{{ url::asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ url::asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection