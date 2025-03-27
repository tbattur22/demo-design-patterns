@php
$activePattern = isset($patternObj) ? $patternObj->getName() : null;
@endphp

<li @class(['border-b border-black-400'=>!$activePattern])><a href="/">Home</a></li>
@if ($patterns)
    @foreach ($patterns as $pattern)
        <li @class(['border-b border-black-400'=>$activePattern === $pattern->getName()])>
            <a href="/design_pattern/{{ $pattern->getName() }}"
                {{ $pattern->getName() }}>{{ $pattern->getLabel() }}</a>
        </li>
    @endforeach
@endif
