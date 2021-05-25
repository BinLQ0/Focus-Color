@extends('_layouts.base')

@section('title', 'Create Rack' )

@section('css')
<link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-4">

        <h2 class="mb-3"> Create Rack</h2>

        <x-card>

            {{ Form::open(array('route' => 'racks.store', 'method' => 'post', 'class' => 'form-horizontal')) }}
            {{ Form::token() }}

            <x-input form='v' name='code' type='text' label='Code' />
            <x-select form='v' name='warehouse_id' label='On Warehouse' />
            <x-textarea form='v' name='note' type='text' label='Note' placeholder="(Optional)" />

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
                                    text: obj.name
                                };
                            })
                        };
                    }
                }
            });
        });

    </script>
@endpush
