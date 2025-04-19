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

                                        <!-- Application Name -->
                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{ get_translation('application_name') }}</label>
                                            <input type="text" value="{{ get_option('application_name') }}"
                                                   name="application_name" class="form-control"
                                                   placeholder="{{ get_translation('application_name') }}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('official_name_of_the_application') }}
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Theme Dropdown (NEW) -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ get_translation('theme') }}</label>
                                            <select name="theme" class="form-control">
                                                <option
                                                    value="light" {{ get_option('theme') == 'light' ? 'selected' : '' }}>
                                                    Light
                                                </option>
                                                <option
                                                    value="dark" {{ get_option('theme') == 'dark' ? 'selected' : '' }}>
                                                    Dark
                                                </option>
                                            </select>
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('choose_application_theme_light_or_dark') }}
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Company Name -->
                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{ get_translation('company_name') }}</label>
                                            <input type="text" value="{{ get_option('company_name') }}"
                                                   name="company_name" class="form-control"
                                                   placeholder="{{ get_translation('company_name') }}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('provide_legal_registered_company_name') }}
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Company Phone -->
                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{ get_translation('company_phone') }}</label>
                                            <input type="text" value="{{ get_option('phone') }}" name="phone"
                                                   class="form-control"
                                                   placeholder="{{ get_translation('company_phone') }}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('provide_valid_contact_number_including_country_code') }}
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Company Website -->
                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{ get_translation('company_website') }}</label>
                                            <input type="text" value="{{ get_option('web_site') }}" name="web_site"
                                                   class="form-control"
                                                   placeholder="{{ get_translation('company_website') }}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('provide_company_website_url') }}
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Company Address -->
                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{ get_translation('company_address') }}</label>
                                            <input type="text" value="{{ get_option('address') }}" name="address"
                                                   class="form-control"
                                                   placeholder="{{ get_translation('company_address') }}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('company_official_address') }}
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Application URL -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ get_translation('app_url') }}</label>
                                            <input value="{{ get_option('app_url') }}"
                                                   name="app_url" type="text" class="form-control"
                                                   placeholder="{{ get_translation('app_url') }}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('your_application_url_for_sending_password_reset_link') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Logo and Favicon -->
                                    <div class="row g-3 mt-3">
                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{ get_translation('application_logo') }}</label>
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
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('upload_high_quality_logo') }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{ get_translation('upload_quality_favicon_image') }}</label>
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
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('upload_quality_favicon_image') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Timezone and SMTP -->
                                    <div class="row g-3 mt-3">

                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{ get_translation('app_timezone') }}</label>
                                            <select name="app_timezone" class="form-control select2">
                                                <option value=""
                                                        disabled>{{ get_translation('select_timezone') }}</option>
                                                @foreach(\DateTimeZone::listIdentifiers() as $timezone)
                                                    <option value="{{ $timezone }}"
                                                        {{ get_option('app_timezone') == $timezone ? 'selected' : '' }}>
                                                        {{ $timezone }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('choose_application_timezone') }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ get_translation('smtp_host') }}</label>
                                            <input type="text" value="{{ get_option('smtp_host') }}" name="smtp_host"
                                                   class="form-control"
                                                   placeholder="{{ get_translation('smtp_host') }}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('provide_smtp_server_address') }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">{{ get_translation('smtp_port') }}</label>
                                            <input type="number" value="{{ get_option('smtp_port') }}" name="smtp_port"
                                                   class="form-control"
                                                   placeholder="{{ get_translation('smtp_port') }}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('provide_smtp_server_port') }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{ get_translation('smtp_username') }}</label>
                                            <input type="text" value="{{ get_option('smtp_username') }}"
                                                   name="smtp_username" class="form-control"
                                                   placeholder="{{ get_translation('smtp_username') }}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('provide_smtp_username') }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{ get_translation('smtp_password') }}</label>
                                            <input type="text" value="{{ get_option('smtp_password') }}"
                                                   name="smtp_password" class="form-control"
                                                   placeholder="{{ get_translation('smtp_password') }}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('provide_smtp_password') }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{ get_translation('smtp_encryption') }}</label>
                                            <select name="smtp_encryption" class="form-control">
                                                <option
                                                    value="tls" {{ get_option('smtp_encryption') == 'tls' ? 'selected' : '' }}>
                                                    TLS
                                                </option>
                                                <option
                                                    value="ssl" {{ get_option('smtp_encryption') == 'ssl' ? 'selected' : '' }}>
                                                    SSL
                                                </option>
                                                <option
                                                    value="none" {{ get_option('smtp_encryption') == 'none' ? 'selected' : '' }}>
                                                    None
                                                </option>
                                            </select>
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('choose_smtp_encryption_type') }}
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{ get_translation('smtp_from_email') }}</label>
                                            <input type="email" value="{{ get_option('smtp_from_email') }}"
                                                   name="smtp_from_email" class="form-control"
                                                   placeholder="{{ get_translation('smtp_from_email') }}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('provide_email_address_to_send_from') }}
                                                </small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label
                                                class="form-label fw-bold">{{ get_translation('chat_gpt_api_key') }}</label>
                                            <input type="text" value="{{ get_option('chat_gpt_api_key') }}"
                                                   name="chat_gpt_api_key" class="form-control"
                                                   placeholder="{{ get_translation('chat_gpt_api_key') }}">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">{{ get_translation('tips') }}</span>
                                                <small class="text-muted">
                                                    {{ get_translation('provide_chat_gpt_api_key') }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-transparent mt-auto">
                                    <div class="btn-list justify-content-end">
                                        <button type="submit" value="Save Settings" class="btn btn-primary">
                                            <x-tabler-adjustments-check/>
                                            {{ get_translation('save_settings') }}
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

@section('js')
    <script>
        "use strict";
        $(document).ready(function () {
            function initializeTomSelect() {
                $(".select2").each(function () {
                    new TomSelect(this, {
                        create: false,
                        onChange: function () {
                            this.blur();
                        }
                    });
                });
            }

            initializeTomSelect();
        });
    </script>
@endsection
