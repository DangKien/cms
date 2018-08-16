<!DOCTYPE html>
<html>
    <head>
        <title> Z軸空間設計 </title>
        <link rel="icon" href="{{ url('Frontend/img/logo_title1.png') }}" type="image/gif" sizes="32x32">
        <script>
            var SiteUrl = '{{url("/")}}';
            var headingNotifi = {
                success: '{!! trans("confirm.success")!!}',
                failue: '{!! trans("confirm.failue")!!}',
                warning: '{!! trans("confirm.warning") !!}'
            };
            var messageNotifi = {
                success: '{!! trans("confirm.message_success")!!}',
                failue: '{!! trans("confirm.message_failue")!!}',
                warning: '{!! trans("confirm.message_warning") !!}'
            };
            var ConfirmBtn = {
                confirm: '{!! trans("confirm.btn_confirm")!!}',
                cancel: '{!! trans("confirm.btn_cancel")!!}',
            };
            var textConfirm = '{!! trans("confirm.text_confirm") !!}';
        </script>
        @includeif ('Backend.Layouts._css_default')
        @includeif ('Backend.Layouts._css')
        @yield('myCss')
        @includeif ('Backend.Layouts._angular')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
    </head>
    <body ng-app="ngApp" ng-cloak class="nifty-ready pace-done">
        <div id="container" class="effect mainnav-lg">
            <div class="boxed">
                @includeif ('Backend.Layouts._header')

                @yield('content')

                @includeif ('Backend.Layouts._menu')
             </div>
            @includeif ('Backend.Layouts._js_default')
            @includeif ('Backend.Layouts._js')
            @yield('myJs')
            @includeif ('Backend.Layouts._footer')
        </div>
    </body>
</html>
