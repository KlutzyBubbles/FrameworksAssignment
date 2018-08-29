<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            margin-bottom: 60px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-color: #f5f5f5;
        }
        body > .container {
            padding: 80px 15px 0;
        }

        .footer > .container {
            padding-right: 15px;
            padding-left: 15px;
        }
    </style>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/pageSize.js') }}"></script>
</head>

<body>
<div class="container">
    @yield('content')
</div>
<footer class="footer">
    <div class="container"><span class="text-muted">&copy; 2018 - Navigation</span></div>
</footer>

</body>
</html>
