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
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">
                    <div id="table-default" class="table-responsive mb-3">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">{{get_translation('from_amount')}}</th>
                                <th class="text-center">{{get_translation('to_amount')}}</th>
                                <th class="text-center">{{get_translation('type')}}</th>
                                <th class="text-center">{{get_translation('bank')}}</th>
                                <th class="text-center">{{get_translation('person')}}</th>
                                <th class="text-center">{{get_translation('date')}}</th>
                                <th class="text-center">{{get_translation('note')}}</th>
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

                    <div class="text-end mb-3">
                        <a href="javascript:void(0);" class="btn btn-primary btn-5 d-none d-sm-inline-block"
                           data-bs-toggle="modal"
                           data-bs-target="#debtRepayModal">
                            <x-tabler-minus/>
                            {{get_translation('repay')}}
                        </a>
                    </div>

                    <div id="table-default" class="table-responsive">
                        <table class="table datatable table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">{{get_translation('from_amount')}}</th>
                                <th class="text-center">{{get_translation('to_amount')}}</th>
                                <th class="text-center">{{get_translation('bank')}}</th>
                                <th class="text-center">{{get_translation('account_holder')}}</th>
                                <th class="text-center">{{get_translation('account_number')}}</th>
                                <th class="text-center">{{get_translation('date')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @foreach($debt->repayments as $repayment)
                                @php
                                    $bank_name = $repayment->account && $repayment->account->bank ? $repayment->account->bank->bank_name : '';
                                    $account_holder_name = $repayment->account ? $repayment->account->account_name : '';
                                    $account_number = $repayment->account ? $repayment->account->account_number : '';
                                    $exchange_currency = $repayment->account && $repayment->account->currency ? $repayment->account->currency->name : '';
                                @endphp
                                <tr>
                                    <td class="text-center"> {{$repayment->currency ? $repayment->currency->name : ''}} {{number_format($repayment->amount, 0)}}</td>
                                    <td class="text-center">{{$exchange_currency}} {{number_format($repayment->exchange_amount, 0)}}</td>
                                    <td class="text-center">{{$bank_name}}</td>
                                    <td class="text-center"> {{$account_holder_name}}</td>
                                    <td class="text-center"> {{$account_number}}</td>
                                    <td class="text-center">{{\Carbon\Carbon::parse($repayment->date)->format('d/m/Y')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="debtRepayModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{get_translation('repay')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <form action="{{ route('debts.storeRepay', [$debt->id]) }}" method="POST" id="storeRepay">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">{{get_translation('select_a_bank_account')}}: <span
                                    class="text-danger">*</span></label>
                            <select name="account_id" class="form-control">
                                <option value="">{{get_translation('select_a_bank_account')}}</option>
                                @foreach($bankAccounts as $bankAccount)
                                    <option value="{{$bankAccount->id}}">
                                        {{$bankAccount->bank->bank_name}} - {{$bankAccount->account_number}} - Balance
                                        ({{$bankAccount->currency->name ?? ''}} {{$bankAccount->balance}})
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-danger mt-2 account_id"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{get_translation('select_currency')}}: <span class="text-danger">*</span></label>
                            <select name="currency_id" class="form-control">
                                <option value="">{{get_translation('select_currency')}}</option>
                                @foreach($currencies as $currency)
                                    <option value="{{$currency->id}}">
                                        {{$currency->name}}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-danger mt-2 currency_id"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{get_translation('amount')}}: <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="amount"
                                   placeholder="Amount">
                            <div class="text-danger pt-2 amount"></div>
                        </div>


                        <div class="mb-3">
                            <label class="form-label">{{get_translation('date')}}: <span
                                    class="text-danger">*</span></label>
                            <div class="input-icon mb-2">
                                <input class="form-control datepicker" name="date"
                                       placeholder="{{get_translation('date')}}"
                                       value=""/>
                                <span class="input-icon-addon"><x-tabler-calendar/></span>
                            </div>
                            <div class="text-danger pt-2 date"></div>
                        </div>

                        <div class="logical-error d-none alert alert-danger"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            {{get_translation('cancel')}}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            {{get_translation('submit')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script src="{{ asset('/js/calendar.js') }}"></script>
    <script>
        "use strict";
        $(document).ready(function () {

            $('#storeRepay').submit(function (e) {
                e.preventDefault();

                $("#debtRepayModal .logical-error").addClass('d-none');

                var form = $(this);
                var url = form.attr('action');
                $.ajax({
                    url: url,
                    type: "POST",
                    data: form.serialize(),
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            var err_response = JSON.parse(xhr.responseText);
                            $.each(err_response.errors, function (key, value) {
                                $("#debtRepayModal ." + key).text(value);
                            });
                        } else if (xhr.status === 400) {
                            var err_response = JSON.parse(xhr.responseText);
                            $("#debtRepayModal .logical-error").removeClass('d-none').show().text(err_response.message);
                        } else {
                            alert("Something went wrong. Please try again.");
                        }
                    }
                });
            });
        });

    </script>
@endsection
