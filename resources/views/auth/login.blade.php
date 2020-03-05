@extends('layouts.basic')
@section('title','Login')
@section('content')

    <div class="login-page">
        <div class="row">
            <div class="col-12">

                <h3 class="text-center m-2">
                    <a href="#" class="logo logo-admin"><img src="{{ asset('images/isoftware-image.png') }}" alt="logo"></a>
                </h3>

                <div class="login-form">
                    <h4 class="font-18 text-center">Welcome Back !</h4>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email">Username</label>
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                            @endif
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="m-t-40 text-center">
                    <p>Don't have an account ? <a href="/register" class="font-500 font-14 text-primary font-secondary"> Signup Now </a> </p>
                </div>
            </div>
        </div>
    </div>
@endsection
