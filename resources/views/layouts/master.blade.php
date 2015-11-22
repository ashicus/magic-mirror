<!DOCTYPE html>

<html>
    <head>
        <title>Magic Mirror - @yield('title')</title>
        <link rel="stylesheet" href="/css/style.css" media="screen" title="no title" charset="utf-8">
        <link rel="stylesheet" href="/css/weather-icons.css" media="screen" title="no title" charset="utf-8">
    </head>

    <body>
        <div class="container main">
            @yield('content')
        </div>

        <script data-main="/js/main" src="/bower_components/jquery/dist/jquery.min.js"></script>
        <script data-main="/js/main" src="/bower_components/requirejs/require.js"></script>
    </body>
</html>
