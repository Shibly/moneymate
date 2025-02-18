@extends('layout.master')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Application Settings
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body p-0">
                    <div class="container-xl">

                        <div class="col-12 d-flex flex-column">

                            <form action="{{route('profile.update-password')}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Current Password</label>
                                            <input type="password" name="current_password" class="form-control"
                                                   placeholder="Current Password">
                                            @error('current_password')
                                            <div class="text-danger pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">New Password</label>
                                            <input type="password" name="new_password" class="form-control"
                                                   placeholder="New Password">
                                            @error('new_password')
                                            <div class="text-danger pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Confirm Password</label>
                                            <input type="password" name="new_password_confirmation" class="form-control"
                                                   placeholder="Confirm Password">
                                            @error('new_password_confirmation')
                                            <div class="text-danger pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-transparent mt-auto">
                                    <div class="btn-list justify-content-end">
                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                    </div>
                                </div>
                            </form>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')


@endsection
