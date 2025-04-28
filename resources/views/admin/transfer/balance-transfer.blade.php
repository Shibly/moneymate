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
                            {{get_translation('make_a_transfer')}}
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
                <div class="card-body p-3">
                    <div id="table-default" class="table-responsive">
                        <table class="table datatable table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">{{get_translation('from_account')}}</th>
                                <th class="text-center">{{get_translation('to_account')}}</th>
                                <th class="text-center">{{get_translation('from_amount')}}</th>
                                <th class="text-center">{{get_translation('to_amount')}}</th>
                                <th class="text-center">{{get_translation('transfer_date')}}</th>
                                <th class="text-center">{{get_translation('note')}}</th>
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
                    <h5 class="modal-title">{{get_translation('make_a_transfer')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <form action="{{ route('transfer.storeBalanceTransfer') }}" method="POST" id="balanceTransfer">
                    @csrf
                    <div class="modal-body">
                        <!-- Professional Tip Message -->
                        <div class="alert alert-info mb-3">
                            <span class="badge bg-blue-lt">{{get_translation('tips')}}:</span>
                            {{get_translation('you_can_transfer_funds_from_your_source_account_to_your_destination_account_if_the_accounts_use_different_currencies_the_system_will_automatically_convert_the_transferred_amount_into_the_destination_accounts_currency')}}
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{get_translation('from_account')}}: <span
                                    class="text-danger">*</span></label>
                            <select name="from_account_id" class="form-control">
                                <option value="">{{get_translation('select_a_bank_account')}}</option>
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
                            <label class="form-label">{{get_translation('to_account')}}: <span
                                    class="text-danger">*</span></label>
                            <select name="to_account_id" class="form-control">
                                <option value="">{{get_translation('select_a_bank_account')}}</option>
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
                            <label class="form-label">{{get_translation('amount')}}: <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="amount"
                                   placeholder="Amount">
                            <div class="text-danger pt-2 amount"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{get_translation('transfer_date')}}: <span
                                    class="text-danger">*</span></label>
                            <div class="input-icon mb-2">
                                <input class="form-control datepicker" name="transfer_date"
                                       placeholder="Select a date"
                                       value=""/>
                                <span class="input-icon-addon"><x-tabler-calendar/></span>
                            </div>
                            <div class="text-danger pt-2 transfer_date"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{get_translation('note')}}:</label>
                            <input type="text" class="form-control" name="note"
                                   placeholder="Note">
                            <div class="text-danger pt-2 note"></div>
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
            $('#balanceTransfer').submit(function (e) {
                e.preventDefault();
                let submitButton = $('button[type="submit"]');
                submitButton.prop('disabled', true).text('{{get_translation('submitting')}}');

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
                    },
                    complete: function () {
                        submitButton.prop('disabled', false).text('{{get_translation('submit')}}');
                    }
                });
            });
        });
    </script>
@endsection
