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
                        <a href="{{ route('category.show', ['id' => $category->id]) }}">{{ $category->title }}</a>
                        <br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@extends('footer')
