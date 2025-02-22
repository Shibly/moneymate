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
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="javascript:void(0);" class="btn btn-primary btn-5 d-none d-sm-inline-block"
                           data-bs-toggle="modal"
                           data-bs-target="#addDebtModal">
                            Add Debt
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
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">From Amount</th>
                                <th class="text-center">To Amount</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Account</th>
                                <th class="text-center">Person</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Note</th>
                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @php
                                $exchange_currency = $debt->bankAccount && $debt->bankAccount->currency ? $debt->bankAccount->currency->name : '';
                            @endphp
                            <tr>
                                <td class="text-center"> {{$debt->currency ? $debt->currency->name : ''}} {{number_format($debt->amount, 0)}}</td>
                                <td class="text-center">{{$exchange_currency}} {{number_format($debt->exchange_amount, 0)}}</td>
                                <td class="text-center">{{ucwords($debt->type)}}</td>
                                <td class="text-center">{{$debt->bankAccount && $debt->bankAccount->bank ? $debt->bankAccount->bank->bank_name : ''}}</td>
                                <td class="text-center"> {{$debt->type == 'borrow' ? 'Borrowed from' : 'Lend to'}}  {{$debt->person}}</td>
                                <td class="text-center">{{\Carbon\Carbon::parse($debt->date)->format('d/m/Y')}}</td>
                                <td class="text-center">{{$debt->note}}</td>
                            </tr>
                            </tbody>
                        </table>
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

        });

    </script>
@endsection
