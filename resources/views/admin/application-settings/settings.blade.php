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
                                        <!-- Row 1: Application Name & Company Name -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Application Name</label>
                                            <input type="text" value="{{ get_option('application_name') }}"
                                                   name="application_name" class="form-control"
                                                   placeholder="Application Name">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">Tip:</span>
                                                <small class="text-muted">
                                                    Enter the official name that will be displayed across your site.
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Company Name</label>
                                            <input type="text" value="{{ get_option('company_name') }}"
                                                   name="company_name" class="form-control"
                                                   placeholder="Company Name">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">Tip:</span>
                                                <small class="text-muted">
                                                    Provide your legal or registered company name.
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Row 2: Company Phone & Website -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Company Phone</label>
                                            <input type="text" value="{{ get_option('phone') }}" name="phone"
                                                   class="form-control" placeholder="Phone">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">Tip:</span>
                                                <small class="text-muted">
                                                    Enter a valid contact number including the country code.
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Website</label>
                                            <input type="text" value="{{ get_option('web_site') }}" name="web_site"
                                                   class="form-control" placeholder="Web Site">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">Tip:</span>
                                                <small class="text-muted">
                                                    Provide your company's website URL (e.g., https://example.com).
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Row 3: Company Address & Registration Type -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Company Address</label>
                                            <input type="text" value="{{ get_option('address') }}" name="address"
                                                   class="form-control" placeholder="Address">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">Tip:</span>
                                                <small class="text-muted">
                                                    Provide the complete address for official correspondence.
                                                </small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Registration Type</label>
                                            <select name="registration_type" class="form-select">
                                                <option value="free"
                                                        @if(get_option('registration_type') == 'free') selected @endif>
                                                    Free
                                                </option>
                                                <option value="monthly_subscription"
                                                        @if(get_option('registration_type') == 'monthly_subscription') selected @endif>
                                                    Monthly Subscription
                                                </option>
                                            </select>
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">Tip:</span>
                                                <small class="text-muted">
                                                    Choose a plan that suits your business model.
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Row 4: Number of Data per Page (full width) -->
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold">Number of Data per Page</label>
                                            <input value="{{ get_option('num_data_per_page') }}"
                                                   name="num_data_per_page"
                                                   type="number" class="form-control"
                                                   placeholder="Number of data per page">
                                            <div class="mt-1">
                                                <span class="badge bg-blue-lt">Tip:</span>
                                                <small class="text-muted">
                                                    Define the number of records to display on each page.
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Fields Group 2: Image Uploads -->
                                    <div class="row g-3 mt-3">
                                        <!-- Application Logo -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Application Logo</label>
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
                                                <span class="badge bg-blue-lt">Tip:</span>
                                                <small class="text-muted">
                                                    Upload a high-quality logo image (recommended size: 100x100px).
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Favicon -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Favicon</label>
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
                                                <span class="badge bg-blue-lt">Tip:</span>
                                                <small class="text-muted">
                                                    Upload a favicon image (recommended size: 64x64px).
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-transparent mt-auto">
                                    <div class="btn-list justify-content-end">
                                        <button type="submit" value="Save Settings" class="btn btn-primary">
                                            <x-tabler-adjustments-check/>
                                            Save Settings
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
