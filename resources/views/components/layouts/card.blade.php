<div class="card card-primary card-outline">

    <div {{ $attributes->class(['card-body table-responsive', 'p-0' => $hasPadding]) }}>

        @if($component)
            <x-dynamic-component :component="$component" :params='$params'/>
        @endif

        {{ $slot }}
    </div>
</div>
