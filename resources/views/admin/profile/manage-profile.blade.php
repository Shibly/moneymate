@extends('layout.master')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{get_translation('update_profile')}}
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body p-3">
                    <div class="container-xl">

                        <div class="col-12 d-flex flex-column">

                            <form action="{{ route('profile.update-profile') }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">{{get_translation('name')}}</label>
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="Enter your name" value="{{ auth()->user()->name }}">
                                            @error('name')
                                            <div class="text-danger pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">{{get_translation('email')}}</label>
                                            <input type="email" name="email" class="form-control"
                                                   placeholder="Enter your email" value="{{ auth()->user()->email }}">
                                            @error('email')
                                            <div class="text-danger pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="col-md-12">
                                            <label
                                                class="form-label fw-bold">{{get_translation('profile_picture')}}</label>
                                            <input type="file" name="profile_picture" class="form-control">
                                            @error('profile_picture')
                                            <div class="text-danger pt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-transparent mt-auto">
                                    <div class="btn-list justify-content-end">
                                        <button type="submit"
                                                class="btn btn-primary">{{get_translation('update')}}</button>
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

