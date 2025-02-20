@extends('layout.master')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Balance Transfer
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary btn-5 d-none d-sm-inline-block" data-bs-toggle="modal"
                           data-bs-target="#modal-report">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="icon icon-tabler icons-tabler-outline icon-tabler-building-bank">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M3 21l18 0"/>
                                <path d="M3 10l18 0"/>
                                <path d="M5 6l7 -3l7 3"/>
                                <path d="M4 10l0 11"/>
                                <path d="M20 10l0 11"/>
                                <path d="M8 14l0 3"/>
                                <path d="M12 14l0 3"/>
                                <path d="M16 14l0 3"/>
                            </svg>
                            Add New
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body p-0">
                    <div id="table-default" class="table-responsive">
                        <table class="table datatable table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Bank Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody class="table-tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
