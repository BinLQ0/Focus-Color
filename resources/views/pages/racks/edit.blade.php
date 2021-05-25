@extends('_layouts.base')

@section('title', 'Rack Update')

@section('css')
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">

        <h2 class="mb-3"> Rack Update </h2>

        <x-card>

            {{ Form::model($rack, ['route' => ['racks.update', $rack->id], 'method' => 'PUT']) }}
            {{ Form::token() }}

            <x-input form='v' name='code' type='text' label='Code' :value='$rack->code' />
            <x-select form='v' name='warehouse_id' label='On Warehouse' />
            <x-textarea form='v' name='note' type='text' label='Note' placeholder="(Optional)" :value="$rack->note" />

            <div class="text-right">
                <button type="submit" class="btn btn-primary mt-3">Save</button>
            </div>

            {{ Form::close() }}

        </x-card>
    </div>
</div>

@endsection

@section('js')
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>
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
                                    text: obj.name,
                                };
                            })
                        };
                    }
                }
            });

            var warehouseSelect = $('select[name="warehouse_id"]');

            $.ajax({
                type: 'GET',
                url: '{{ url("/api/warehouse/". $rack->warehouse->id) }}'
            }).then(function (data) {
                // create the option and append to Select2
                console.log(data.name);
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
        });

    </script>
@endpush
