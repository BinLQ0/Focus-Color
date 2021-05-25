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

        <h2 class="mb-3"> Create Product Result </h2>

        {{ Form::open(array('route' => 'result.store', 'method' => 'post', 'class' => 'form-horizontal')) }}
        {{ Form::token() }}

        <x-card>

            <div class="row">
                <div class="col-6">
                    <x-date form='v' name='date' label="Result Date" />
                </div>
                <div class="col-6">
                    <x-select form='v' name='for' label='No. Lot' />
                </div>
                <div class="col-12">
                    <x-input form='v' name='description' label="Product" placeholder='~ Empty ~' readonly />
                </div>
                <div class="col-12">
                    <H3>PRODUCTION REPORT</H3>
                </div>
                <div class="col-12">
                    <x-input form='v' name='materialUse' label="Material Used" class='text-right' value='0' disabled />
                </div>
                <div class="col-12">
                    <x-input form='v' name='materialLoss' label="Material Loss" class='text-right' value='0' disabled />
                </div>
            </div>

        </x-card>

        <x-card has-padding='true'>
            <x-tables.location-list-table />
        </x-card>

        <div class="row mb-3">
            <div class="col-8 align-items-center" style="font-size: 24px;">
                <label for="total">Material Weight : 0 Kg</label>
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

{{-- <script src="{{ url::asset('js/calculation.js') }}"></script> --}}
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('select[name="for"]').select2({
                ajax: {
                    delay: 250,
                    url: '{{ route("api.release") }}',
                    data: function (params) {
                        var queryParameters = {
                            search: params.term,
                            status: 'processing',
                            hasTotal: true,
                        }

                        return queryParameters;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function (obj) {
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
        });

        $('select[name="for"]').on('select2:select', function (evt) {
            var product = evt.params.data.product;
            var used = Number.parseFloat(evt.params.data.used);

            $('input[name="description"]').val(product);
            $('input[name="materialUse"]').val(used);
        });

    </script>
@endpush
