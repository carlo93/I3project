@extends('layouts.basic')
@section('title','Register')
@section('content')

    <div class="card">
        <div class="card-body">

            <h3 class="text-center">
                <a href="/login" class="logo logo-admin"><img src="{{ asset('images/isoftware-image.png') }}" alt="logo"></a>
            </h3>

            <div class="row">
                <div class="col-12">
                    <h4 class="text-muted font-18 m-b-5 text-center">Register New User</h4>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input id="full_name" name="full_name" type="text" class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="full_name" value="{{ old('full_name') }}" required autofocus>

                            @if ($errors->has('full_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('full_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="balance">Starting Balance</label>
                            <input id="balance" name="balance" type="number" class="form-control{{ $errors->has('balance') ? ' is-invalid' : '' }}" name="balance" value="{{ old('balance') }}" required autofocus>

                            @if ($errors->has('balance'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('balance') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="row m-t-20">
                            <div class="col-12 text-right">
                                <button class="btn btn-primary w-md" type="submit">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
