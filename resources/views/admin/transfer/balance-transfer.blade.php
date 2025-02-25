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
                           data-bs-target="#balanceTransferModal">
                            <x-tabler-transfer/>
                            Make a Transfer
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
                                <th class="text-center">From Account</th>
                                <th class="text-center">To Account</th>
                                <th class="text-center">From Amount</th>
                                <th class="text-center">To Amount</th>
                                <th class="text-center">Transfer Date</th>
                                <th class="text-center">Note</th>
                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @foreach($accountTransfers as $accountTransfer)
                                @php
                                    $from_account_currency = $accountTransfer->fromAccount && $accountTransfer->fromAccount->currency ? $accountTransfer->fromAccount->currency->name : '';
                                    $to_account_currency = $accountTransfer->toAccount && $accountTransfer->toAccount->currency ? $accountTransfer->toAccount->currency->name : '';
                                @endphp
                                <tr>
                                    <td class="text-center">
                                        {{$accountTransfer->fromAccount ? $accountTransfer->fromAccount->account_number : '' }}
                                        - {{ $accountTransfer->fromAccount && $accountTransfer->fromAccount->bank ? $accountTransfer->fromAccount->bank->bank_name : ''}}
                                    </td>
                                    <td class="text-center">
                                        {{$accountTransfer->toAccount ? $accountTransfer->toAccount->account_number : '' }}
                                        - {{ $accountTransfer->toAccount && $accountTransfer->toAccount->bank ? $accountTransfer->toAccount->bank->bank_name : ''}}
                                    </td>
                                    <td class="text-center">{{$from_account_currency}} {{$accountTransfer->amount}}</td>
                                    <td class="text-center">{{$to_account_currency}} {{$accountTransfer->exchange_amount}}</td>
                                    <td class="text-center">{{\Carbon\Carbon::parse($accountTransfer->transfer_date)->format('d/m/Y')}}</td>
                                    <td class="text-center">{{$accountTransfer->note}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Balance Transfer Modal -->
    <div class="modal modal-blur fade" id="balanceTransferModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Make a Transfer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <form action="{{ route('transfer.storeBalanceTransfer') }}" method="POST" id="balanceTransfer">
                    @csrf
                    <div class="modal-body">
                        <!-- Professional Tip Message -->
                        <div class="alert alert-info mb-3">
                            <span class="badge bg-blue-lt">Tip:</span>
                            You can transfer funds from your source account to your destination account. If the accounts
                            use different currencies, the system will automatically convert the transferred amount into
                            the destination account’s currency.
                        </div>

                        <div class="mb-3">
                            <label class="form-label">From Account: <span class="text-danger">*</span></label>
                            <select name="from_account_id" class="form-control">
                                <option value="">Select a Bank Account</option>
                                @foreach($bankAccounts as $bankAccount)
                                    <option value="{{$bankAccount->id}}">
                                        {{$bankAccount->bank->bank_name}} - {{$bankAccount->account_number}} - Balance
                                        ({{$bankAccount->currency->name ?? ''}} {{$bankAccount->balance}})
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-danger mt-2 from_account_id"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">To Account: <span class="text-danger">*</span></label>
                            <select name="to_account_id" class="form-control">
                                <option value="">Select a Bank Account</option>
                                @foreach($bankAccounts as $bankAccount)
                                    <option value="{{$bankAccount->id}}">
                                        {{$bankAccount->bank->bank_name}} - {{$bankAccount->account_number}} - Balance
                                        ({{$bankAccount->currency->name ?? ''}} {{$bankAccount->balance}})
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-danger pt-2 to_account_id"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Amount: <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="amount"
                                   placeholder="Amount">
                            <div class="text-danger pt-2 amount"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Transfer Date: <span class="text-danger">*</span></label>
                            <div class="input-icon mb-2">
                                <input class="form-control datepicker" name="transfer_date"
                                       placeholder="Select a date"
                                       value=""/>
                                <span class="input-icon-addon"><x-tabler-calendar/></span>
                            </div>
                            <div class="text-danger pt-2 transfer_date"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Note:</label>
                            <input type="text" class="form-control" name="note"
                                   placeholder="Note">
                            <div class="text-danger pt-2 note"></div>
                        </div>

                        <div class="logical-error d-none alert alert-danger"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <x-tabler-transfer/>
                            Make a Transfer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script src="{{ asset('public/js/calendar.js') }}"></script>
    <script>
        "use strict";

        $(document).ready(function () {
            $('#balanceTransfer').submit(function (e) {
                e.preventDefault();

                $("#balanceTransferModal .logical-error").addClass('d-none');

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
                                $("#balanceTransferModal ." + key).text(value);
                            });
                        } else if (xhr.status === 400) {
                            var err_response = JSON.parse(xhr.responseText);
                            $("#balanceTransferModal .logical-error").removeClass('d-none').show().text(err_response.message);
                        } else {
                            alert("Something went wrong. Please try again.");
                        }
                    }
                });
            });
        });
    </script>
@endsection
