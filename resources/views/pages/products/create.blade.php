@extends('_layouts.base')

@section('title', 'Create Product' )

@section('css')
<!-- Select2  -->
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
<!-- Date Range Picker  -->
<link rel="stylesheet" href="{{ URL::asset('plugins/daterangepicker/daterangepicker.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">

        <h2 class="mb-3"> Create Product </h2>

        {{ Form::open(array('route' => 'products.store', 'method' => 'post', 'class' => 'form-horizontal')) }}
        {{ Form::token() }}

        <x-card>
            <x-input form='v' name='name' type='text' label='Product Name' />
            <x-input form='v' name='description' type='text' label='Description' placeholder="(Optional)" />
            <x-select form='v' name='inventory_id' label='Product Type' :option='$type' />
            <x-select form='v' name='warehouse_id' label='Default Warehouse' />
            <x-select form='v' name='rack_id' label='Default Rack' />
        </x-card>

        <x-card>
            <div class="row">
                <div class="col-6">
                    <x-date form='v' name='date' label="Date Start Balance" />
                </div>
                <div class="col-4">
                    <x-input form='v' name='first_balance' type='number' class="text-right" label='Opening Stock'
                        value='0' />
                </div>
                <div class="col-2">
                    <x-input form='v' name='unit' type='text' class="text-right" label='Unit'
                        placeholder='kg / gr / pcs' />
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

@push('js')
    <script>
        $(document).ready(function () {
            $('select[name="warehouse_id"]').select2({
                ajax: {
                    url: '{{ url("api/warehouses") }}',
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (obj) {
                                return {
                                    id: obj.id,
                                    text: obj.name
                                };
                            })
                        };
                    }
                }
            });

            $('select[name="rack_id"]').select2({
                ajax: {
                    url: '{{ url("api/racks") }}',
                    data: function (params) {
                        return {
                            warehouse: $('select[name="warehouse_id"]').val(),
                        }
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function (obj) {
                                return {
                                    id: obj.id,
                                    text: obj.code
                                };
                            })
                        };
                    }
                }
            });
        });

    </script>
@endpush
