<div class='design_pattern_section mt-16'>
    @if (isset($home))
        <div class="home max-w-3xl m-4 p-4">
            @include('Home')
        </div>            
    @elseif ($patternObj)
        <div class="my-4 font-bold mx-auto text-center">
            <p class='m-4 p-4 md:max-w-3xl'>{!! nl2br(e($patternObj->describe())) !!}</p>
        </div>
        @if (isset($targetClassInstance))
            @include(get_class($targetClassInstance))
        @endif
    @endif
</div>
