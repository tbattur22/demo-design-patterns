@if (isset($targetClassInstance))
    @php
    $desc = $patternObj->describe();
    @endphp
@endif

<div class='design_pattern_section mt-16'>
    @if (isset($home))
        <div class="home max-w-3xl m-4 p-4">
            @include('Home')
        </div>
    @elseif ($patternObj)
        <div class="my-4 font-bold mx-auto text-center">
            <div class='m-4 p-4 md:max-w-3xl'>
                <label>{{ $desc }}</label>
            </div>
        </div>
        @if (isset($targetClassInstance))
            @include("App\Models\Vehicles\Vehicle")
        @endif
    @endif
</div>
