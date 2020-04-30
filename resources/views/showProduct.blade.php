@extends('layout')

@extends('navigation')

@section('content')
    <div class="container">
        <div class="title ">
            Shopping cart
        </div>
        <div class="container">
            <div class="row justify-content-md-center">
                @foreach ($products as $product)
                    <h3>{{ $product->title }}</h3>
                    <div class="col-md-auto">{{ $product->description }}</div>
                    <p>${{ $product->price }}</p>
                    <a href="/categories/{{ $product->id }}">{{ $product->name }}</a>
                @endforeach
            </div>
        </div>
    </div>
@stop

@extends('footer')
