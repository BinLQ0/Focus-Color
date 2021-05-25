@extends('_layouts.base')

@section('title', 'Product Edit')

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

        {{ Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'PUT']) }}
        {{ Form::token() }}

        <x-card>

            <x-input form='v' name='name' type='text' label='Product Name' :value='$product->name' />
            <x-input form='v' name='description' type='text' label='Description' placeholder="(Optional)"
                :value='$product->description' />
            <x-select form='v' name='inventory_id' label='Product Type' :option='$type'
                :selected='[$product->inventory_id]' />
            <x-select form='v' name='warehouse_id' label='Default Warehouse' />
            <x-select form='v' name='rack_id' label='Default Rack' />

        </x-card>

        <x-card>
            <div class="row">
                <div class="col-6">
                    <x-date form='v' name='date' label="Date Start Balance"
                        :value='$product->initDetails->first()->date' />
                </div>
                <div class="col-4">
                    <x-input form='v' name='first_balance' type='number' class="text-right" label='Opening Stock'
                        value='0' :value='$product->initDetails->first()->pivot->quantity' />
                </div>
                <div class="col-2">
                    <x-input form='v' name='unit' type='text' class="text-right" label='Unit'
                        placeholder='kg / gr / pcs' :value='$product->unit' />
                </div>
            </div>
        </x-card>

        <div class="text-right">
            <button type="submit" class="btn btn-primary mt-3">Save</button>
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
                        console.log('select');
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

            var warehouseSelect = $('select[name="warehouse_id"]');

            $.ajax({
                type: 'GET',
                url: '{{ url("/api/warehouse/". $product->warehouse->id) }}'
            }).then(function (data) {
                // create the option and append to Select2
                var option = new Option(data.name, data.id, true, true);
                warehouseSelect.append(option).trigger('change');

                // manually trigger the `select2:select` event
                warehouseSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: $.map(data, function (obj) {
                            return {
                                id: obj.id,
                                text: obj.name,
                            };
                        })
                    }
                });
            });

            var rackSelect = $('select[name="rack_id"]');

            $.ajax({
                type: 'GET',
                url: '{{ url("/api/rack/". $product->rack->id) }}'
            }).then(function (data) {
                
                // create the option and append to Select2
                var option = new Option(data.code, data.id, true, true);
                rackSelect.append(option).trigger('change');

                // manually trigger the `select2:select` event
                rackSelect.trigger({
                    type: 'select2:select',
                    params: {
                        data: data
                    }
                })
            });
        });

    </script>
@endpush
