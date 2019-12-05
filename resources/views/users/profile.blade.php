@extends('layouts.app')
@section('title', 'Profile - Online Florist')

@section('content')
<div class="content">
    <h2>Profile</h2>
    <div class="content-container">
        <!-- form for updating current user -->
        <form action="/profile/update/{{ $user->id }}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- name field -->
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="{{ $user->name }}" value="{{ old('name') }}" autocomplete="name" autofocus>
                    <!-- error message if name validation fails -->
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- email address field -->
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                <div class="col-md-6">
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ $user->email }}" value="{{ old('email') }}" autocomplete="email">
                    <!-- error message if email address validation fails -->
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- phone number field -->
            <div class="form-group row">
                <label for="phone-number" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                <div class="col-md-6">
                    <input id="phone-number" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="{{ $user->phone }}" value="{{ old('phone') }}" autocomplete="tel-national">
                    <!-- error message if phone number validation fails -->
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- gender radio buttons -->
            <div class="form-group row mb-0">
                <label for="gender" class="col-md-4 col-form-label text-md-right">Gender</label>
                <div class="col-md-6 col-form-label text-md-left">
                    <label><input id="gender" type="radio" class="checkbox @error('gender') is-invalid @enderror" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>Male</label>
                    <br>
                    <label><input id="gender" type="radio" class="checkbox @error('gender') is-invalid @enderror" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>Female</label>
                    <!-- error message if gender validation fails -->
                    @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- address textarea -->
            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                <div class="col-md-6">
                    <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="{{ $user->address }}" autocomplete="street-address">{{ old('address') }}</textarea>
                    <!-- error message if address validation fails -->
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- image upload field -->
            <div class="form-group row">
                <label for="profile_picture" class="col-md-4 col-form-label text-md-right">Image</label>
                <div class="col-md-6">
                    <input id="profile_picture" type="file" class="form-control @error('profile_picture') is-invalid @enderror" name="profile_picture" value="{{ old('profile_picture') }}">
                    <!-- error message if image validation fails -->
                    @error('profile_picture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <!-- update button to attempt update -->
            <div class="form-group row mb-3">
                <div class="col-md-8 offset-md-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection