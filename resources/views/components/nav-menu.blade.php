@php
$activePattern = isset($patternObj) ? $patternObj->getName() : null;
@endphp

<li @class(['border-b border-black-400'=>!$activePattern])><a href="{{ route('home') }}">Home</a></li>
@isset($patterns)
    @foreach ($patterns as $pattern)
        <li @class(['border-b border-black-400'=>$activePattern === $pattern->getName()])>
            <a href="{{ route('designPattern', $pattern->getName()) }}"
                {{ $pattern->getName() }}>{{ $pattern->getLabel() }}</a>
        </li>
    @endforeach
@endisset
