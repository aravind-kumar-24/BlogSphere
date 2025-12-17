<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BlogSphere</title>
    <link rel="icon" href="{{asset('images/Favicon.jpg')}}"/>
    <link rel="stylesheet" href="{{asset('css/main.css')}}"/>
    <style>
        body{
            background-color: #F5F1EE;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            margin: auto;
            box-sizing: border-box
        }
    </style>
</head>
<body>
    @include('includes.Header')

    @yield('content')

    @include('includes.Footer')
</body>
</html>