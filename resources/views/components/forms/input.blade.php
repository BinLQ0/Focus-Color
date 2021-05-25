<div class="input-group {{ $margin }}">
    <input name='{{ $name }}' {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
        {{ $attributes }} value='{{ old($name) ?? $value ?? '' }}'>

    @if($icon)
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="{{ $icon }}"></span>
            </div>
        </div>
    @endif

    @error( $name )
        <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>
