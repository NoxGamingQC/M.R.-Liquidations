<!doctype html>
<html lang="{{ app()->getLocale() }}" class="welcome-page">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="M.R.Liquidations's Website">
    <meta name="author" content="M.R.Liquidations">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(env('APP_ENV', 'developement'))
    <title>{{env('APP_ENV') == 'developement' ? 'Dev - ' : ''}}M.R. Liquidations - @yield('title')</title>
    @else
    <title>M.R. Liquidations - @yield('title')</title>
    @endif
    <link rel="icon" href="/img/favicon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{mix('css/app.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
    
</head>

<body class="welcome-page">
    @yield('content')
    @include('layouts.footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="{{mix('js/app.js')}}"></script>
    <script type="text/javascript">
        console.log("%c{{trans('general.console_wait')}}", 'color:#F00; font-size:60px; font-weight: bold; -webkit-text-stroke: 1px black;');
        console.log("%c{!!trans('general.console_copy_paste01')!!}", 'color:#FFF; font-size:18px;');
        console.log("%c{{trans('general.console_copy_paste02')}}", 'color:#F00; font-size:18px;');
        console.log("%c{{trans('general.console_close_window')}}", 'color:#FFF; font-size:18px;');
        console.log("%c{!!trans('general.console_copy_paste03')!!}", 'color:#FFF; font-size:18px;');
    </script>
</body>

</html>
