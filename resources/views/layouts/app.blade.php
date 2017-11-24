<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"> <!--app()->getLocale()用于获取config/app.php中的locale选项-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!--csrf-token是为了方便前端的javascript脚本获取CSRF令牌-->

    <title>@yield('title', 'LaraBBS') - Laravel进阶教程</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!--asset函数用于生成css的url地址-->
</head>

<body>
<div id="app" class="{{ route_class() }}-page">  <!--route_class()为系统自定义的函数-->

    @include('layouts._header')

    <div class="container">
        @include('layouts._message')
        @yield('content')

    </div>

    @include('layouts._footer')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>