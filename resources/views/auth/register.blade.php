@extends('layouts.app')
@section('title', 'Register - Online Florist')

@section('content')
<div class="content log-reg">
    <h2>Register</h2>
    <div class="content-container">
        <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                <div class="col-md-6">
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="phone-number" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                <div class="col-md-6">
                    <input id="phone-number" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="tel-national">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
                <div class="col-md-6 col-form-label text-md-left">
                    <label><input id="gender" type="radio" class="checkbox @error('gender') is-invalid @enderror" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>Male</label>
                    <br>
                    <label><input id="gender" type="radio" class="checkbox @error('gender') is-invalid @enderror" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>Female</label>
                    @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                <div class="col-md-6">
                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" autocomplete="street-address">{{ old('address') }}</textarea>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  value="{{ old('password_confirmation') }}" autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="profile_picture" class="col-md-4 col-form-label text-md-right">Image</label>
                <div class="col-md-6">
                    <input id="profile_picture" type="file" class="form-control @error('profile_picture') is-invalid @enderror" name="profile_picture" value="{{ old('profile_picture') }}">
                    @error('profile_picture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="form-group row mb-3">
                <div class="col-md-8 offset-md-2">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
