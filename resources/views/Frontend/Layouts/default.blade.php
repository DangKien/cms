<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon-->
        <link rel="shortcut icon" href="img/fav.png">
        <!-- Author Meta -->
        <meta name="author" content="colorlib">
        <!-- Meta Description -->
        <meta name="description" content="">
        <!-- Meta Keyword -->
        <meta name="keywords" content="">
        <!-- meta character set -->
        <meta charset="UTF-8">
        <!-- meta token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Site Title -->
        <title>Magazine</title>
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">

        <link rel="icon" href="{{ url('Frontend/img/logo_title1.png') }}" type="image/gif" sizes="32x32">
        <script>
            var SiteUrl = '{{url("/")}}';
        </script>
        @includeif ('Frontend.Layouts._css_default')
        @includeif ('Frontend.Layouts._css')
        @yield('myCss')
        @includeif ('Frontend.Layouts._angular')
        
        
    </head>
    <body ng-app="ngApp" ng-cloak>
        @includeif ('Frontend.Layouts._header')
        
        @yield('content')

        @includeif ('Frontend.Layouts._menu')
        @includeif ('Frontend.Layouts._footer')

        @includeif ('Frontend.Layouts._js_default')
        @includeif ('Frontend.Layouts._js')

        @yield('myJs')
        @php
            $ggAnalytic = app('Setting')->getGgAnalytic();
        @endphp
        {!! @$ggAnalytic->setting->google_analytic !!}
    </body>
</html>
