@extends('_layouts.base')

@section('title', 'Data Product' )

@section('css')
<!-- Select2  -->
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<!-- Date Range Picker  -->
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">

        @if(isset($product))

            {{-- Update Product --}}
            <h2 class="mb-3"> Update Product </h2>

            {{ Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'PUT']) }}
            {{ Form::token() }}

            {{-- ./Update Product --}}
        @else

            {{-- Create Product --}}
            <h2 class="mb-3"> Create Product </h2>

            {{ Form::open(['route' => 'products.store', 'method' => 'post', 'class' => 'form-horizontal']) }}
            {{ Form::token() }}

            @php
                $product = null;
            @endphp

            {{-- ./Create Product --}}
        @endif

        <x-card>

            <x-input name='name' type='text' label='Product Name' :bind='$product' />
            <x-input name='description' type='text' label='Description' placeholder="(Optional)" :bind='$product' />
            <x-select select2 name='inventory_id' label='Product Type' :option='$type' />

        </x-card>

        <x-card>

            <div class="row">
                <div class="col-6">
                    <x-input name='date' label="Date Start Balance" :bind='$product' daterangepicker/>
                </div>
                <div class="col-4">
                    <x-input name='first_balance' type='number' class="text-right" label='Opening Stock' :bind='$product' />
                </div>
                <div class="col-2">
                    <x-input name='unit' type='text' class="text-right" label='Unit' placeholder='kg / gr / pcs' :bind='$product' />
                </div>
            </div>
        </x-card>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

        {{ Form::close() }}
    </div>
</div>
@endsection

@section('js')
<!-- Select2  -->
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- MomentJS  -->
<script src="{{ url::asset('plugins/moment/moment.min.js') }}"></script>
<!-- Date Range Picker  -->
<script src="{{ url::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
@endsection
