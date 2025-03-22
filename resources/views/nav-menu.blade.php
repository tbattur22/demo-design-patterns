<li><a href="/">Home</a></li>
@if ($patterns)
    @foreach ($patterns as $pattern)
        <li>
            <a href="/design_pattern/{{ $pattern->getName() }}"
                {{ $pattern->getName() }}>{{ $pattern->getLabel() }}</a>
        </li>
    @endforeach
@endif
