@extends('_layouts.base')

@section('title', 'Create Product Result')

@section('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<!-- Date Range Picker -->
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">

@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">

        @if(isset($result))

            {{-- Update Product Result --}}
            <h2 class="mb-3"> Update Product Result </h2>

            {{ Form::model($result, ['route' => ['result.update', $result->id], 'method' => 'PUT']) }}
            {{ Form::token() }}

            {{-- ./Update Product Result --}}
        @else

            {{-- Create Product Result --}}
            <h2 class="mb-3"> Create Product Result </h2>

            {{ Form::open(array('route' => 'result.store', 'method' => 'post', 'class' => 'form-horizontal')) }}
            {{ Form::token() }}

            @php
                $result = null;
                $release = null;
            @endphp

        @endif

        <x-card theme-mode='outline' theme='primary'>

            <div class="row">
                <div class="col-6">
                    <x-input daterangepicker name='date' label="Result Date" :bind='$result' />
                </div>
                <div class="col-6">
                    <x-select name='for' label='No. Lot' :option='$result ? [optional($release)->id => optional($release)->for] : []' :bind='$release' />
                </div>
                <div class="col-12">
                    <x-input name='description' label="Product" placeholder='~ Empty ~' :bind='$result' readonly />
                </div>
                <div class="col-12">
                    <H3>PRODUCTION REPORT</H3>
                </div>
                <div class="col-12">
                    <x-input name='materialUsed' label="Material Used" class='text-right' :bind='$result' disabled />
                </div>
                <div class="col-12">
                    <x-input name='materialLoss' label="Material Loss" class='text-right' disabled />
                </div>
            </div>

        </x-card>

        <x-card theme-mode='outline' theme='primary' body-class='p-0'>
            <x-tables.product-list-table :only='["location", "quantity"]' :products='optional($result)->products' />
        </x-card>

        <div class="row mb-3">
            <div class="col-8 align-items-center" style="font-size: 24px;">
                <label for="">Production Result : </label><b><span id='total'> 0 Kg </span></b>
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
<!-- Datepicker Script -->
<script src="{{ url::asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url::asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Select2 Script -->
<script src="{{ url::asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Datatable Script -->
<script src="{{ url::asset('plugins/datatables/jquery.dataTables.js') }}"></script>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var $numLot = $('select[name="for"]');

            $numLot.select2({
                ajax: {
                    delay: 250,
                    url: '{{ route("api.release") }}',
                    data: function(params) {
                        var queryParameters = {
                            search: params.term,
                            status: 'processing',
                            total: true,
                        }

                        return queryParameters;
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data.data, function(obj) {
                                return {
                                    id: obj.id,
                                    text: obj.for,
                                    product: obj.description,
                                    used: obj.used,
                                };
                            })
                        };
                    }
                }
            });

            $numLot.on('select2:select', function(evt) {
                var product = evt.params.data.product;
                var used = Number.parseFloat(evt.params.data.used);
                
                $('input[name="description"]').val(product);
                $('input[name="materialUsed"]').val(used);
            });
        });
    </script>
@endpush