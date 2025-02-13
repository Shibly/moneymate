<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Moneymate - Personal finance manager</title>
    <!-- CSS files -->

    <link href="{{asset('public/css/tabler.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/tabler-flags.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/tabler-socials.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/tabler-payments.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/tabler-vendors.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/tabler-marketing.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/demo.min.css')}}" rel="stylesheet">

    <style>
        @import url('https://rsms.me/inter/inter.css');
    </style>
</head>
<body class=" layout-fluid">
<script src="{{asset('public/dist/js/demo-theme.min.js')}}"></script>

<div class="page">
    <!-- Sidebar -->
    @include('includes.sidebar')
    <div class="page-wrapper">
        @yield('content')
        @include('includes.footer')
    </div>
</div>

<script src="{{asset('public/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('public/libs/jsvectormap/dist/jsvectormap.min.js')}}"></script>
<script src="{{asset('public/libs/jsvectormap/dist/maps/world.js')}}"></script>
<script src="{{asset('public/js/tabler.min.js')}}"></script>
<script src="{{asset('public/js/demo.min.js')}}"></script>
</body>
</html>
