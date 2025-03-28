@php
    $patternObj = $patternObj ?? null;
    $home = $home ?? null;
    $targetClassInstance = $targetClassInstance ?? null;
@endphp

<x-app-layout>
<x-nav-section :patterns="$patterns" :patternObj="$patternObj">
    
</x-nav-section>
<x-design-pattern-section :patterns="$patterns" :patternObj="$patternObj" :home="$home" :targetClassInstance="$targetClassInstance">

</x-design-pattern-section>

</x-app-layout>