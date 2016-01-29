<!doctype html>
<html class="no-js" lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Stars War - {{$title}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    {{--todo en cas de non connexion, n'utiliser QUE la font font-awesome.css en local --}}
    <link rel="stylesheet" href="{{url('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/knacss.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/app.min.css')}}">
</head>
<body class="max-1200">
    <header id="header" role="banner" class="line txtcenter pas mas">
        @include('partials.nav')
    </header>
    <div id="main" role="main" class="line pas">
        @yield('content')
    </div>
    <footer id="footer" role="contentinfo" class="line pam txtcenter">
        <span><a href="{{url('/')}}">Home</a></span>
    </footer>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
        <script>window.jQuery || document.write('<script src="{{asset('assets/js/jquery-1.11.2.min.js')}}"><\/script>')</script>
        <script src="{{asset('assets/js/main.min.js')}}"></script>
</body>
</html>
