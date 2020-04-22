@extends('layout')

@extends('navigation')

@section('content')
    <div class="row">
        <h1>Register</h1>
        <form action="{{ route('user.register') }}" method="post">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="text" id="email" name="email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>

            <button type="submit" class="btn">Register</button>

            {{ csrf_field() }}
        </form>
    </div>
@endsection

@extends('footer')
