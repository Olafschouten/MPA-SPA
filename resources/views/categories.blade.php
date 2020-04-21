@extends('layout')

@extends('navigation')

@section('content')
    <div class="content">
        @foreach ($tests as $test)
            <p>{{ $test->name }}</p>
        @endforeach
    </div>
@stop

@extends('footer')
