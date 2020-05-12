@extends('layout')

@extends('navigation')

@section('content')
    <div class="container">
        <div class="title">Products</div>

        <style>
            .test {
                height: 260px;
                margin: 10px;
            }

            .bottom-align-text {
                position: absolute;
                bottom: 0;
            }
        </style>

        <div class="row" style="float: none; margin: 0 auto;">
            @foreach ($products as $product)
                <div class="col-md-3 img-thumbnail test">
                    <h3>{{ $product->title }}</h3>
                    <p>{{ $product->description }}</p>
                    <p>${{ $product->price }}</p>
                    <p class="clearfix bottom-align-text">
                        <a href="{{ route('product.addToCart', ['id' => $product->id]) }}"
                           class="btn btn-primary pull-left" role="button">Add to cart</a>
                        <a href="/products/{{ $product->id }}" class="btn btn-secondary pull-right" role="button">Link
                            to product</a>
                    </p>
                </div>
            @endforeach
        </div>
    </div>
@stop

@extends('footer')
