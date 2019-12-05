@extends('layouts.app')
@section('title', 'Login - Online Florist')

@section('content')
<div id="login" class="content log-reg">
    <h2>Login</h2>
    <div class="content-container">
        <!-- form for users to login -->
        <form action="{{ route('login') }}" method="post">
            @csrf
            <!-- email address field -->
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <!-- error message if email authorization fails -->
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- password field -->
            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <!-- error message if password authorization fails -->
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- remember me checkbox for cookies -->
            <div class="form-group row">
                <div class="col-md-6 offset-md-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                </div>
            </div>

            <!-- login button to attempt login -->
            <div class="form-group row my-0">
                <div class="col-md-8 offset-md-2">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </div>

            <!-- link to redirect to forget password page -->
            @if (Route::has('password.request'))
            <div class="form-group row my-0">
                <div class="col-md-8 offset-md-2">
                    <a class="btn btn-link" href="{{ route('password.request') }}">Forgot Your Password?</a>
                </div>
            </div>
            @endif
        </form>
    </div>
</div>
@endsection
