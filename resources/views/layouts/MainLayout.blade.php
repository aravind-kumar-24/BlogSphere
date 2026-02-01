<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BlogSphere</title>
    <link rel="icon" href="{{asset('images/Favicon.jpg')}}"/>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
    <div id="loader">
        <div class="spinner" ></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div id="loader" class="loader" style="display:none;"></div>
    @yield('content')
</body>
</html>