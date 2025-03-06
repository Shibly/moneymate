<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{get_option('application_name')}}</title>
    <link href="{{asset('css/tabler.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/demo.min.css')}}" rel="stylesheet">
</head>

<body class=" d-flex flex-column" @if(get_option('theme') === 'dark') data-bs-theme="dark" @endif>
<div class="page">
    <div class="container container-tight py-4">
        <div class="card card-md">
            <div class="card-body">
                <h2 class="h2 text-center mb-4">Login to your account</h2>
                <form action="{{route('login')}}" method="post" autocomplete="off" novalidate>
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input name="email" type="email" class="form-control" placeholder="your@email.com"
                               autocomplete="off">
                        @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label">
                            Password
                            <span class="form-label-description"><a href="{{route('password.request')}}">I forgot password</a></span>
                        </label>
                        <div class="input-group input-group-flat">
                            <input name="password" type="password" class="form-control" placeholder="Your password"
                                   autocomplete="off">
                        </div>
                        @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">Sign in</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
</div>

<script src="{{asset('js/tabler.min.js')}}"></script>
<script src="{{asset('js/demo.min.js')}}"></script>
</body>
</html>
