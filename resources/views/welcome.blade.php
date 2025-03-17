@extends('main_layout')

@section('main-content')
    <nav>
        <ul>
            <li>Home</li>
            @if ($patterns)
                @foreach ($patterns as $pattern)
                    <li>{{ $pattern }}</li>
                @endforeach
            @endif
        </ul>
    </nav>
@endsection
