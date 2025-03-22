@extends('layout')

@section('nav-section')
    <div class='bg-blue-400'>
        <nav class='flex justify-center items-center'>
            <ul class="hidden sm:flex justify-center items-center gap-6 lg:gap-8 rounded-full px-12 py-3 ">
                @include('nav-menu')
            </ul>

            {{-- mobile menu --}}
            <ul class="sm:hidden flex flex-col items-center gap-4 px-10 py-20 fixed
            top-0 bottom-0 w-64 z-50 bg-blue-400">
                @include('nav-menu')
            </ul>
        </nav>
    </div>

@endsection

@section('design-pattern-section')
    <div class=''>
        @if (isset($home))
            <h1>Home section goes here</h1>
        @elseif ($patternObj)
            <h1>Design Pattern Section</h1>
            <p>{!! nl2br(e($patternObj->describe())) !!}</p>
            @if (isset($targetClassInstance))
                {{-- @dd(get_class($targetClassInstance)::getMakeAndModels()); --}}
                @include(get_class($targetClassInstance))
            @endif
        @endif
    </div>
@endsection
