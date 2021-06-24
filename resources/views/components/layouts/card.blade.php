<div class="{{ $makeCardClass() }}">

    @isset($title)
        {{-- Card header --}}
        <div class="card-header">

            {{-- Title --}}
            <h3 class="card-title">
                <b>{!! $title !!}</b>
            </h3>
            {{-- ./Title --}}

            {{-- Tools --}}
            @if($hasTools())
                <div class="card-tools">
                    
                    {{-- Collapsible --}}
                    @if($collapsible === 'collapsed')
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    @elseif(isset($collapsible))
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    @endif
                    {{-- ./Collapsible --}}
                </div>
            @endif
            {{-- ./Tools --}}

        </div>
    @endisset
    {{-- ./Card Header --}}

    {{-- Card Body --}}
    <div class="{{ $makeCardBodyClass() }}">

        {{-- Dynamic Component --}}
        @isset($component)
            <x-dynamic-component :component="$component" />
        @endisset
        {{-- ./Dynamic Component --}}

        {{ $slot }}

    </div>
    {{-- ./Card Body --}}

</div>
