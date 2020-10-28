@extends('layout')

@extends('navigation')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Send mail request</h1>
            <form action="{{ route('email.sendEmail') }}" method="post">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control">
                </div>

                <div class="form-group">
                    <label for="message">Password</label>
                    <input type="text" id="message" name="message" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Send email</button>

                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection

@extends('footer')
