@extends('_layouts.base')

@section('title', 'Job Cost')

@section('css')

<link rel="stylesheet" href="{{ URL::asset('plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">

@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-6">

        @if(isset($jobcost))

            {{-- Update Jobcost --}}
            <h2 class="mb-3"> Update Jobcost </h2>

            {{ Form::model($jobcost, ['route' => ['jobcost.update', $jobcost->id], 'method' => 'PUT']) }}
            {{ Form::token() }}

            {{-- ./Update Jobcost --}}
        @else

            {{-- Create Jobcost --}}
            <h2 class="mb-3"> Create Jobcost </h2>

            {{ Form::open(array('route' => 'jobcost.store', 'method' => 'post', 'class' => 'form-horizontal')) }}
            {{ Form::token() }}

            @php
                $jobcost = null;
            @endphp

        @endif

        <x-card>

            <div class="row">
                <div class="col-sm-6">
                    <x-input daterangepicker name='date' label="Date" :bind='$jobcost'/>
                </div>
                <div class="col-sm-6">
                    <x-select name='for' type='text' label='Used For...' :option='$referance' :bind='$jobcost' />
                </div>
                <div class="col-sm-12">
                    <x-input name='description' label='Note' placeholder='(Optional)' :bind='$jobcost'/>
                </div>
            </div>
        </x-card>

        <x-card theme-mode='outline' theme='primary' body-class='p-0'>
            <x-tables.product-list-table header='Products' :products='optional($jobcost)->products' />
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
