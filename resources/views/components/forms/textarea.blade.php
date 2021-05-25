<textarea class="form-control {{ $class }}" rows="3" @error( $name ) is-invalid @enderror {{ $attributes }}
    name={{ $name }}> {{ old($name) ?? $value ?? '' }}</textarea>
