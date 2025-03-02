<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{get_option('application_name')}}</title>
    <link href="{{ asset('css/tabler.min.css') }}" rel="stylesheet">
</head>
<body class=" d-flex flex-column">
<div class="page">
    <div class="container container-tight py-4">
        {{-- Display session success or error messages (optional) --}}
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form class="card card-md" action="{{ route('password.email') }}" method="POST" autocomplete="off" novalidate>
            @csrf
            <div class="card-body">
                <h2 class="h2 text-center mb-4">{{get_translation('forgot_password')}}</h2>
                <p class="text-secondary mb-4">
                    {{get_translation('enter_your_email_address_and_we_will_email_you_a_password_reset_link')}}
                </p>

                {{-- Email field --}}
                <div class="mb-3">
                    <label class="form-label">{{get_translation('email_address')}}</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="{{get_translation('email_address')}}"
                        value="{{ old('email') }}"
                        required
                    >
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        {{get_translation('send_me_new_password')}}
                    </button>
                </div>
            </div>
        </form>

        <div class="text-center text-secondary mt-3">
            Forget it, <a href="{{ route('login') }}">send me back</a> to the sign in screen.
        </div>
    </div>
</div>

<script src="{{ asset('public/js/demo.min.js') }}"></script>
</body>
</html>
