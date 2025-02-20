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

                            <form action="{{route('settings.update')}}" method="post">
                                <div class="card-body">
                                    @csrf
                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Company Name</label>
                                            <input type="text" value="{{get_option('company_name')}}"
                                                   name="company_name" class="form-control"
                                                   placeholder="Company Name">
                                        </div>


                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Company Phone</label>
                                            <input type="text" value="{{get_option('phone')}}" name="phone"
                                                   class="form-control" placeholder="Phone">
                                        </div>


                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Website</label>
                                            <input type="text" value="{{get_option('web_site')}}" name="web_site"
                                                   class="form-control"
                                                   placeholder="Web Site">
                                        </div>


                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Company Address</label>
                                            <input type="text" value="{{get_option('address')}}" name="address"
                                                   class="form-control"
                                                   placeholder="Address">
                                        </div>


                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Registration Type</label>
                                            <select name="registration_type" class="form-select">
                                                <option value="free">Free</option>
                                                <option value="monthly_subscription">Monthly Subscription</option>
                                            </select>
                                        </div>


                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Number of Data per Page</label>
                                            <input value="{{get_option('num_data_per_page')}}" name="num_data_per_page"
                                                   type="number" class="form-control"
                                                   placeholder="Number of data per page">
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

@section('js')


@endsection
