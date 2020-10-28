@extends('layout')

@extends('navigation')

@section('content')
    <div class="container">
        <div class="title">Products</div>

        @if (Session::has('out_of_stock'))
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div id="charge-message" class="alert alert-danger">
                        {{ Session::get('out_of_stock') }}
                    </div>
                </div>
            </div>
        @endif

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
                            @if ($product->quantity <= 0)
                                <p class="text-danger">Out of Stock!</p>
                            @elseif ($product->quantity >= 1 && $product->quantity <= 5)
                                <p class="text-danger">Almost Out of Stock!</p>
                            @elseif ($product->quantity >= 6)
                                <p class="text-success">In Stock!</p>
                            @endif
                        </div>
                        <hr>
                        @if ($product->quantity >= 1)
                            <a href="{{ route('product.addToCart', ['id' => $product->id]) }}"
                               class="btn btn-primary pull-left" role="button">Add to cart</a>
                        @elseif ($product->quantity <= 0)
                            <a href="{{ route('email.show') }}"
                               class="btn btn-primary pull-left" role="button">Send request</a>
                        @endif
                        <a href="{{ route('product.show', ['id' => $product->id]) }}"
                           class="btn btn-secondary pull-right" role="button">Link
                            to product</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop

@extends('footer')
