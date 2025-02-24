@extends('layout.master')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{$title}}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body p-0">
                    <div class="container-xl">
                        <div class="col-12 d-flex flex-column">
                            <form action="{{ route('settings.update') }}" method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    @csrf
                                    <!-- Fields Group 1 -->
                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{get_translation('application_name')}}</label>
                                            <input type="text" value="{{ get_option('application_name') }}"
                                                   name="application_name" class="form-control"
                                                   placeholder="{{get_translation('application_name')}}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{get_translation('tips')}}</span>
                                                <small class="text-muted">
                                                    {{get_translation('official_name_of_the_application')}}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{get_translation('company_name')}}</label>
                                            <input type="text" value="{{ get_option('company_name') }}"
                                                   name="company_name" class="form-control"
                                                   placeholder="{{get_translation('company_name')}}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{get_translation('tips')}}</span>
                                                <small class="text-muted">
                                                    {{get_translation('provide_legal_registered_company_name')}}
                                                </small>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{get_translation('company_phone')}}</label>
                                            <input type="text" value="{{ get_option('phone') }}" name="phone"
                                                   class="form-control"
                                                   placeholder="{{get_translation('company_phone')}}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{get_translation('tips')}}</span>
                                                <small class="text-muted">
                                                    {{get_translation('provide_valid_contact_number_including_country_code')}}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{get_translation('company_website')}}</label>
                                            <input type="text" value="{{ get_option('web_site') }}" name="web_site"
                                                   class="form-control"
                                                   placeholder="{{get_translation('company_website')}}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{get_translation('tips')}}</span>
                                                <small class="text-muted">
                                                    {{get_translation('provide_company_website_url')}}
                                                </small>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{get_translation('company_address')}}</label>
                                            <input type="text" value="{{ get_option('address') }}" name="address"
                                                   class="form-control"
                                                   placeholder="{{get_translation('company_address')}}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{get_translation('tips')}}</span>
                                                <small class="text-muted">
                                                    {{get_translation('company_official_address')}}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{get_translation('number_of_data_per_page')}}</label>
                                            <input value="{{ get_option('num_data_per_page') }}"
                                                   name="num_data_per_page"
                                                   type="number" class="form-control"
                                                   placeholder="{{get_translation('number_of_data_per_page')}}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{get_translation('tips')}}</span>
                                                <small class="text-muted">
                                                    {{get_translation('number_of_records_to_display_per_page')}}
                                                </small>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row g-3 mt-3">
                                        <!-- Application Logo -->
                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{get_translation('application_logo')}}</label>
                                            <input type="file" name="app_logo" class="form-control">
                                            @if(get_option('app_logo'))
                                                <div class="mt-3">
                                                    <div
                                                        class="d-flex justify-content-center align-items-center border rounded shadow-sm"
                                                        style="width: 100px; height: 100px;">
                                                        <img
                                                            src="{{ route('private.files', ['filename' => get_option('app_logo')]) }}"
                                                            alt="App Logo"
                                                            class="img-fluid"
                                                            style="max-height: 100px; max-width: 100px; object-fit: contain;">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{get_translation('tips')}}</span>
                                                <small class="text-muted">
                                                    {{get_translation('upload_high_quality_logo')}}
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Favicon -->
                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{get_translation('upload_quality_favicon_image')}}</label>
                                            <input type="file" name="favicon" class="form-control">
                                            @if(get_option('favicon'))
                                                <div class="mt-3">
                                                    <div
                                                        class="d-flex justify-content-center align-items-center border rounded shadow-sm"
                                                        style="width: 100px; height: 100px;">
                                                        <img
                                                            src="{{ route('private.files', ['filename' => get_option('favicon')]) }}"
                                                            alt="Favicon"
                                                            class="img-fluid"
                                                            style="max-height: 64px; max-width: 64px; object-fit: contain;">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{get_translation('tips')}}</span>
                                                <small class="text-muted">
                                                    {{get_translation('upload_quality_favicon_image')}}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-transparent mt-auto">
                                    <div class="btn-list justify-content-end">
                                        <button type="submit" value="Save Settings" class="btn btn-primary">
                                            <x-tabler-adjustments-check/>
                                            {{get_translation('save_settings')}}
                                        </button>
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
