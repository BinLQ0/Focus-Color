<div class="{{ $makeFormGroupClass() }}">

    <!-- Label Input -->
    @isset($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endisset

    <!-- Input Group -->
    <div class="input-group {{ $makeInputGroupClass() }}">

        <!-- Input Forms -->
        @yield('input-item')

        <!-- Show when input group has error -->
        @error( $name )
            <span class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>
