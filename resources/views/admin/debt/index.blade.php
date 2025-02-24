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
                            <x-tabler-plus/>
                            Add Lend/Borrow
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="alert alert-info">
                <span class="badge bg-blue-lt">Tip:</span>
                From here you can track the money you've <strong>lent</strong> to others or
                <strong>borrowed</strong> from them. Both lending and
                borrowing transactions are directly associated with the bank account you select when creating a
                record.
            </div>
            <div class="card">
                <div class="card-body p-0">
                    <div id="table-default" class="table-responsive">
                        <table class="table datatable table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">From Amount</th>
                                <th class="text-center">To Amount</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Account</th>
                                <th class="text-center">Person</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Note</th>
                                <th class="text-center" width="20%">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @foreach($debts as $debt)
                                @php
                                    $exchange_currency = $debt->bankAccount && $debt->bankAccount->currency ? $debt->bankAccount->currency->name : '';
                                @endphp
                                <tr id="row-{{$debt->id}}">
                                    <td class="text-center"> {{$debt->currency ? $debt->currency->name : ''}} {{number_format($debt->amount, 0)}}</td>
                                    <td class="text-center">{{$exchange_currency}} {{number_format($debt->exchange_amount, 0)}}</td>
                                    <td class="text-center">{{ucwords($debt->type)}}</td>
                                    <td class="text-center">{{$debt->bankAccount && $debt->bankAccount->bank ? $debt->bankAccount->bank->bank_name : ''}}</td>
                                    <td class="text-center"> {{$debt->type == 'borrow' ? 'Borrowed from' : 'Lend to'}}  {{$debt->person}}</td>
                                    <td class="text-center">{{\Carbon\Carbon::parse($debt->date)->format('d/m/Y')}}</td>
                                    <td class="text-center">{{$debt->note}}</td>
                                    <td class="text-center">
                                        <a href="{{route('debts.show', [$debt->id])}}" class="btn btn-info edit-btn">
                                            <x-tabler-edit/>
                                            Manage
                                        </a>
                                        <button class="btn btn-danger delete-btn" data-id="{{ $debt->id }}">
                                            <x-tabler-trash/>
                                            Delete
                                        </button>
                                    </td>
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
    <div class="modal modal-blur fade" id="addDebtModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Lend/Borrow</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>

                <form action="{{ route('debts.store') }}" method="POST" id="addDebt">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Select Bank Account: <span class="text-danger">*</span></label>
                            <select name="account_id" class="form-control">
                                <option value="">Select a Bank Account</option>
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
                            <label class="form-label">Select Currency: <span class="text-danger">*</span></label>
                            <select name="currency_id" class="form-control">
                                <option value="">Select Currency</option>
                                @foreach($currencies as $currency)
                                    <option value="{{$currency->id}}">
                                        {{$currency->name}}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-danger mt-2 currency_id"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Amount: <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="amount"
                                   placeholder="Amount">
                            <div class="text-danger pt-2 amount"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Type: <span class="text-danger">*</span></label>
                            <select name="type" class="form-control">
                                <option value="">Select Type</option>
                                <option value="lend">Lend</option>
                                <option value="borrow">Borrow</option>
                            </select>
                            <div class="text-danger mt-2 type"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Person: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="person"
                                   placeholder="Person">
                            <div class="text-danger pt-2 person"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date: <span class="text-danger">*</span></label>
                            <div class="input-icon mb-2">
                                <input class="form-control" name="date"
                                       placeholder="Select a date"
                                       id="datepicker" value="" required/>
                                <span class="input-icon-addon"><x-tabler-calendar/></span>
                            </div>
                            <div class="text-danger pt-2 date"></div>
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
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade modal-blur" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                         stroke-linejoin="round" class="icon mb-2 text-danger icon-lg">
                        <path d="M12 9v4"></path>
                        <path
                            d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path>
                        <path d="M12 16h.01"></path>
                    </svg>
                    <h3>Are you sure to delete this debt?</h3>
                    <div class="text-secondary">This action cannot be undone.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                    </button>
                    <button type="button" class="btn btn-danger" id="confirm-delete">Yes, Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        "use strict";

        $(document).ready(function () {
            $('#addDebt').submit(function (e) {
                e.preventDefault();

                $("#addDebtModal .logical-error").addClass('d-none');

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
                                $("#addDebtModal ." + key).text(value);
                            });
                        } else if (xhr.status === 400) {
                            var err_response = JSON.parse(xhr.responseText);
                            $("#addDebtModal .logical-error").removeClass('d-none').show().text(err_response.message);
                        } else {
                            alert("Something went wrong. Please try again.");
                        }
                    }
                });
            });


            let deletedId;
            $(document).on('click', '.delete-btn', function () {
                deletedId = $(this).data('id');
                $('#modal-delete').modal('show');
            });

            $('#confirm-delete').click(function () {
                $.ajax({
                    url: "{{ url('debts/destroy') }}/" + deletedId,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        $('#modal-delete').modal('hide');
                        $('#row-' + deletedId).remove();
                        Swal.fire({
                            title: "Deleted!",
                            text: "Debt has been deleted",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                    },
                    error: function (xhr) {
                        console.log("Error deleting category:", xhr);
                    }
                });
            });

        });


    </script>
@endsection
