<!DOCTYPE html>
<html lang="en">
    <head>
        @yield ('metaData')
        
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
    <body onload="startTime()" ng-app="ngApp" ng-cloak>
        @includeif ('Frontend.Layouts._menu')

        <div id="wrapper-container" class="site-wrapper-container">
            @includeif ('Frontend.Layouts._header')
        
            @yield('content')

        
            @includeif ('Frontend.Layouts._footer')

            @includeif ('Frontend.Layouts._js_default')
            @includeif ('Frontend.Layouts._js')
        </div>
        @yield('myJs')
        @php
            $ggAnalytic = app('Setting')->getGgAnalytic();
        @endphp
        {!! @$ggAnalytic->setting->google_analytic !!}
        <div class="load-page">
            <div class="sk-cube-grid">
                <div class="sk-cube sk-cube1"></div>
                <div class="sk-cube sk-cube2"></div>
                <div class="sk-cube sk-cube3"></div>
                <div class="sk-cube sk-cube4"></div>
                <div class="sk-cube sk-cube5"></div>
                <div class="sk-cube sk-cube6"></div>
                <div class="sk-cube sk-cube7"></div>
                <div class="sk-cube sk-cube8"></div>
                <div class="sk-cube sk-cube9"></div>
            </div>
        </div>
    </body>
</html>
