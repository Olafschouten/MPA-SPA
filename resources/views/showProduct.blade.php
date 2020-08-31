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
                    <br>
                    <span>Items left: {{ $product->quantity }}</span>
                    <p>${{ $product->price }}</p>
                    @if ($product->quantity >= 1)
                        <a href="{{ route('product.addToCart', ['id' => $product->id]) }}"
                           class="btn btn-primary pull-left" role="button">Add to cart</a>
                    @elseif ($product->quantity <= 0)
                    <a href="{{ route('product.addToCart', ['id' => $product->id]) }}"
                       class="btn btn-primary pull-left" role="button">Send request</a>
                    @endif
                    <br>
                    <br>
                    @foreach($categories as $category)
                        <a href="/categories/{{ $category->id }}">{{ $category->title }}</a>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
@stop

@extends('footer')
