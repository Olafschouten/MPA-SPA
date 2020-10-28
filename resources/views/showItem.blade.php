@extends('layout')

@extends('navigation')

@section('content')
    <div class="container">
        <div class="title ">
            Shopping cart
        </div>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-auto">
                    <h2>{{ $category->title }}</h2>
                </div>
                @foreach ($products as $product)
                    <div class="col-md-3">
                        <h3>{{ $product->title }}</h3>
                        <p>{{ $product->description }}</p>
                        <p>${{ $product->price }}</p>
                        <a href="/products/{{ $product->id }}">Link to product</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop

@extends('footer')
