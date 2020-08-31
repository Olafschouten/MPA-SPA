@extends('layout')

@extends('navigation')

@section('content')
    <div class="container">
        <div class="title">Products</div>

        <div class="row" style="float: none; margin: 0 auto;">
            @foreach ($products as $product)
                <div class="col-md-3 img-thumbnail test">
                    <h3>{{ $product->title }}</h3>
                    <p>{{ $product->description }}</p>

                    <div class="clearfix bottom-align-text b-m-15">
                        <div class="pull-left">
                            ${{ $product->price }}
                        </div>
                        <div class="pull-right">
                            @if ($product->quantity <= 5)
                                <p class="text-danger">Bijna op!</p>
                            @elseif ($product->quantity >= 6)
                                <p class="text-success">Op voorraad!</p>
                            @elseif ($product->quantity >= 0)
                                <p class="text-success">Voorraad op!</p>
                            @endif
                        </div>
                        <hr>
                        <a href="{{ route('product.addToCart', ['id' => $product->id]) }}"
                           class="btn btn-primary pull-left" role="button">Add to cart</a>
                        <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn btn-secondary pull-right" role="button">Link
                            to product</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop

@extends('footer')
