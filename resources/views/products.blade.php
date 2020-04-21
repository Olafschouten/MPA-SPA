@extends('layout')

@extends('navigation')

@section('content')
    <div class="container">
        <div class="title ">
            Products
        </div>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                    @foreach ($products as $product)
                        <a href="/products/{{ $product->id }}">{{ $product->title }}</a>
                        <br>
                    @endforeach
                </div>
{{--                <div class="col-md-auto">--}}
{{--                    This is some content where you can add some text you want!--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
@stop

@extends('footer')
