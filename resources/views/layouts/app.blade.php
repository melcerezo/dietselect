<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <!-- Josefin Slab & Sans Font - Logo/Headers -->
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,600|Josefin+Slab:400,700" rel="stylesheet">

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="/css/vendor/font-awesome.css">

    <!-- Materialize CSS -->
    <link rel="stylesheet" href="/css/vendor/materialize.css" media="screen,projection">

    <!-- Main CSS -->
    <link rel="stylesheet" href="/css/main.css">

    <!-- Error CSS -->
    <link rel="stylesheet" href="/css/error.css">

    <!-- Modernizr JS Script -->
    <script src="/js/vendor/modernizr-2.8.3.min.js" defer></script>

    <!-- Loads jQuery -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" defer></script>
    <script>window.jQuery || document.write('<script src="/js/vendor/jquery.js"><\/script>')</script>

    <!-- Materialize jQuery Script -->
    <script src="/js/vendor/materialize.js" defer></script>

    <script src="/js/bootstrap-select.min.js"></script>

    <!-- jQuery Validation Script -->
    <script src="/js/vendor/jquery.validate.js" defer></script>

    <script src="/js/plugins.js" defer></script>
    <script src="/js/main.js" defer></script>
    @if (session('status'))
        <script>
            jQuery(window).load(function() {
                Materialize.toast("{{ session('status') }}", 7000, 'rounded');
            });
        </script>
    @endif
    @if (session('status2'))
        <script>
            jQuery(window).load(function() {
                Materialize.toast("{{ session('status2') }}", 7000, 'rounded');
            });
        </script>
    @endif

    @yield('head')
</head>
<body class="{{ ! empty($bgClass) ? $bgClass : '' }}">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
    @yield('content')

    @yield('scripts')

</body>
</html>
