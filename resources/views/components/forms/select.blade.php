<select name='{{ $name }}'
    {{ $attributes->class(['form-control cselect', 'is-invalid' => $errors->has($name)]) }}
    style="width: 100%;">
    <option value={{$placeholderKey}}>{{ $placeholder }}</option>
    @foreach($option as $key => $value)
        <option
            {{ $isSelected($key) ? 'selected="selected"' : '' }}
            value={{ $key }}>{{ $value }}</option>
    @endforeach
</select>

@error($name)
    <span class="error invalid-feedback">{{ $message }}</span>
@enderror

@once
    @prepend('js')
        <script>
            $(document).ready(function () {
                $('.cselect').select2();
            });
        </script>
    @endprepend
@endonce
