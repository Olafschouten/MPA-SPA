@extends('layout')

@extends('navigation')

@section('content')
    <div class="container">
        <div class="title">Products</div>

        <div class="container">
            <div class="row justify-content-md-center">
                @foreach ($products as $product)
                    <div class="col-md-4 img-thumbnail">
                        <h3>{{ $product->title }}</h3>
                        <p>{{ $product->description }}</p>
                        <p>${{ $product->price }}</p>
{{--                        <a href="/products/{{ $product->id }}">Link to product</a>--}}
                        <p class="clearfix">
                            <a href="{{ route('product.addToCart', ['id' => $product->id]) }}" class="btn btn-primary pull-left" role="button">Add to cart</a>
                            <a href="/products/{{ $product->id }}" class="btn btn-secondary pull-right" role="button">Link to product</a>
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop

@extends('footer')
