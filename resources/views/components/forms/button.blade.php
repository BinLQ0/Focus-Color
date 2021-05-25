<a href="{{ $url }}"
    {{ $attributes->class('btn') }}>

    @if ($icon)
        <i class=" mr-1 {{ $icon }}"></i>
    @endif

    {{ $label }}
</a>
