@extends('layout')

@extends('navigation')

@section('content')
    <div class="container">
        <div class="title ">
            Categories
        </div>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                    @foreach ($categories as $category)
                        <a href="/categories/{{ $category->id }}">{{ $category->name }}</a>
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
