<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Moneymate - Personal finance manager</title>
    <link href="{{ asset('css/tabler.min.css') }}" rel="stylesheet">
</head>
<body class=" d-flex flex-column">
<div class="page">
    <div class="container container-tight py-4">
        <form class="card card-md" action="{{ route('password.update') }}" method="POST" autocomplete="off" novalidate>
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Reset Password</h2>

                {{-- Hidden inputs: token & email come from the password reset link --}}
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ request('email') }}">

                <div class="mb-3">
                    <label class="form-label">New Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Enter new password"
                        required
                    >
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Confirm new password"
                        required
                    >
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">
                        Reset Password
                    </button>
                </div>
            </div>
        </form>

        <div class="text-center text-secondary mt-3">
            <a href="{{ route('login') }}">Back to sign in</a>
        </div>
    </div>
</div>

<script src="{{ asset('public/js/demo.min.js') }}"></script>
</body>
</html>
