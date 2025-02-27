<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{get_option('application_name')}} @if(isset($title)) :: {{$title}} @endif </title>
    <!-- CSS files -->
    <link href="{{asset('/libs/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/tabler.css')}}" rel="stylesheet">
    <link href="{{asset('/css/tabler-vendors.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/demo.min.css')}}" rel="stylesheet">
    <link href="{{asset('/libs/datatable/datatable.css')}}" rel="stylesheet">

    @yield('css')
    <style>
        @import url('https://rsms.me/inter/inter.css');
    </style>


    @if(get_option('favicon'))
        <link rel="icon" type="image/x-icon" href="{{ route('private.files', ['filename' => get_option('favicon')]) }}">
    @endif
</head>
<body class=" layout-fluid">

<script>
    let num_data_per_page = '{{get_option('num_data_per_page')}}';

</script>
<script src="{{asset('/js/demo-theme.js')}}"></script>

<div class="page">
    <!-- Sidebar -->
    @include('includes.sidebar')

    <div class="page-wrapper">


        @include('includes.topbar')

        {{--        Display global form validation error during the development time--}}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
        @include('includes.footer')
    </div>
</div>

<script src="{{asset('/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{asset('/libs/litepicker/dist/litepicker.js')}}" defer></script>
<script src="{{asset('/libs/tom-select/dist/js/tom-select.base.min.js')}}" defer></script>
<script src="{{asset('/js/tabler.min.js')}}"></script>
<script src="{{asset('/js/demo.min.js')}}"></script>
<script src="{{ asset('/libs/datatable/datatable.js') }}"></script>
<script src="{{ asset('/libs/select2/select2.min.js') }}"></script>
<script src="{{ asset('/libs/sweetalert/sweetalert2.js') }}"></script>
<script src="{{ asset('/js/main.js') }}"></script>

@yield('js')
</body>
</html>
