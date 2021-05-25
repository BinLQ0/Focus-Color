@extends('components.forms.input-group-component')
@section('input-item')

<!-- Input Field -->
<input name='{{ $name }}'
    {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }} />

<!-- Icon -->
@isset($icon)

    <!-- Input Group Append -->
    <div class="input-group-append">

        <!-- Input Group Icon -->
        <div class="input-group-text">
            <span class="{{ $icon }}"></span>
        </div>
        <!-- ./Input Group Icon -->

    </div>
    <!-- ./Input Group Append -->
@endisset

@overwrite
