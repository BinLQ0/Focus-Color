<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
    </div>
    <input id='{{ $name }}' name='{{ $name }}'
        {{ $attributes->class(['form-control float-right', 'is-invalid' => $errors->has($name)]) }}
        value={{ old($name) ?? $value }}>

    @error($name)
        <span class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>

@prepend('js')
    <script>
        $('#{{ $name }}').daterangepicker({
            locale: {
                format: 'DD/MM/YYYY'
            },
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 2011,
            maxYear: parseInt(moment().format('YYYY'), 10),
        });

    </script>
@endprepend
