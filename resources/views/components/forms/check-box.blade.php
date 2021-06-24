<div class="{{ $makeFormGroupClass() }}">
    <div class="{{ $makeCheckClass() }}">
        <input id='{{ $name }}' type="checkbox" {{ $isChecked }}>
        <label for='{{ $name }}'>{{ $label }}</label>
    </div>
</div>