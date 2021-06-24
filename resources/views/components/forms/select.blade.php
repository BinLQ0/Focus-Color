@extends('components.forms.input-group-component')
@section('input-item')

{{-- Select Field --}}
<select name='{{ $name }}' {{ $attributes->class(['form-control select2', 'is-invalid' => $errors->has($name)]) }}
    style="width: 100%;">

    {{-- Placeholder --}}
    @if(isset($placeholder))
        <option value=''>{{ $placeholder }}</option>
    @endif

    {{-- Options --}}
    @foreach($option as $key => $value)
        <option {{ $isSelected($key) ? 'selected="selected"' : '' }} value={{ $key }}>{{ $value }}</option>
    @endforeach
    {{-- ./Options --}}

</select>
{{-- ./Select Field --}}

@overwrite

    @isset($select2)
        @once
            @prepend('css')
                <!-- Select2  -->
                <link rel="stylesheet" href="{{ URL::asset('plugins/select2/css/select2.min.css') }}">
            @endprepend

            @prepend('js')
                <!-- Select2  -->
                <script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>

                {{-- Custom Script --}}
                <script>
                    $(document).ready(function() {
                        $('.select2').select2();
                    });
                </script>
            @endprepend
        @endonce
    @endisset