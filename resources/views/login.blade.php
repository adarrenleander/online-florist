@extends('layout.master')
<link href="{{ asset('css/login.css') }}" rel="stylesheet">
<title>Login - Online Florist</title>

@section('content')
<div class="content-container">
    <div class="content">
        <h2>Login</h2>
        <form action="/login" method="post">
            <input type="text" placeholder="Email Address">
            <br>
            <input type="password" placeholder="Password">
            <br>
            <input type="checkbox"><label>Remember Me</label>
            <br>
            <input type="submit" value="Login">
            <br><br>
            <a href="/login">Forgot your password?</a>
        </form>
    </div>
</div>
@endsection