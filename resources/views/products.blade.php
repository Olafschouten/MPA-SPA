@extends('layout')

@extends('navigation')

@section('content')
    <div class="content">
        @foreach ($products as $product)
            <p>{{ $product->title }}</p>
        @endforeach
    </div>
@stop

@extends('footer')
