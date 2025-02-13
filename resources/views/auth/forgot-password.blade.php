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
<body class=" d-flex flex-column">
<script src="{{asset('public/js/demo-theme.min.js')}}"></script>
<div class="page">
    <div class="container container-tight py-4">
        <form class="card card-md" action="#" method="post" autocomplete="off" novalidate>
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Forgot password</h2>
                <p class="text-secondary mb-4">Enter your email address and your password will be reset and emailed to
                    you.</p>
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" class="form-control" placeholder="Enter email">
                </div>
                <div class="form-footer">
                    <a href="#" class="btn btn-primary btn-4 w-100">
                        Send me new password
                    </a>
                </div>
            </div>
        </form>
        <div class="text-center text-secondary mt-3">
            Forget it, <a href="{{route('login')}}">send me back</a> to the sign in screen.
        </div>
    </div>
</div>
</div>
</div>
</div>

<script src="{{asset('public/js/tabler.min.js')}}"></script>
<script src="{{asset('public/js/demo.min.js')}}"></script>
</body>
</html>
