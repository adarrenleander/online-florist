<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <!-- setting style -->
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">

    <!-- setting font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    @include('layout.header')
    @yield('content')
    @include('layout.footer')
</body>
</html>