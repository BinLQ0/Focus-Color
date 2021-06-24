@extends('_layouts.base')

@section('title', 'Create Release Material')

@section('css')
<!-- Select2  -->
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<!-- Date Range Picker  -->
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-6">

        @if(isset($release))

            {{-- Update Release Material --}}
            <h2 class="mb-3"> Update Release Material </h2>

            {{ Form::model($release, ['route' => ['release.update', $release->id], 'method' => 'PUT']) }}
            {{ Form::token() }}

            {{-- ./Update Release Material --}}
        @else

            {{-- Create Release Material --}}
            <h2 class="mb-3"> Create Release Material </h2>

            {{ Form::open(array('route' => 'release.store', 'method' => 'post', 'class' => 'form-horizontal')) }}
            {{ Form::token() }}

            @php
                $release = null;
            @endphp

        @endif

        <x-card theme-mode='outline' theme='primary'>

            <div class="row">
                <div class="col-6">
                    <x-input name='date' label="Release Date" :bind='$release' daterangepicker />
                </div>
                <div class="col-6">
                    <x-input name='for' label='No. Lot' :bind='$release' />
                </div>
                <div class="col-12">
                    <x-select name='description' label='Product' :option='$finish_good' :bind='$release' select2/>
                </div>
            </div>

        </x-card>

        <x-card theme-mode='outline' theme='primary' body-class='p-0'>
            <x-tables.product-list-table header='Material' product-type='material' :products='optional($release)->products' />
        </x-card>

        <div class="row">
            <div class="col-8 align-items-center" style="font-size: 24px;">
                <label for="total">Material Weight :</label><b><span id='total'> 0 Kg</span></b>
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
<!-- Select2  -->
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- MomentJS  -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<!-- Date Range Picker  -->
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Datatable Script -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
@endsection