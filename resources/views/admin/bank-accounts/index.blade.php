@extends('layout.master')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        List Of Bank Accounts
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{route('accounts.store')}}" class="btn btn-primary btn-5 d-none d-sm-inline-block"
                           data-bs-toggle="modal"
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
                    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Account</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>

                                <form id="add-bank-account-form" action="{{ route('banks.store') }}" method="POST">
                                    @csrf

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Account Holders Name</label>
                                            <input type="text" class="form-control" name="account_name"
                                                   placeholder="Account Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Account Number</label>
                                            <input type="text" class="form-control" name="account_number"
                                                   placeholder="Account Number" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Select Bank</label>
                                            <select class="form-control" name="bank_name_id" required>
                                                @foreach($banks as $bank)
                                                    <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a bank.</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Select Currency</label>
                                            <select class="form-control" name="currency_id" required>
                                                @foreach($currencies as $currency)
                                                    <option value="{{$currency->id}}">{{$currency->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a currency.</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Initial Balance</label>
                                            <input type="number" class="form-control" name="balance"
                                                   placeholder="Initial Balance" step="0.01" required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
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
                                            Add New Bank Account
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal modal-blur fade" id="modal-edit-account" tabindex="-1" role="dialog"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Bank Account</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>

                                <form id="edit-bank-account-form" action="{{ route('accounts.update', ':id') }}"
                                      method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Account Holders Name</label>
                                            <input type="text" class="form-control" name="account_name"
                                                   id="edit-account-name" placeholder="Account Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Account Number</label>
                                            <input type="text" class="form-control" name="account_number"
                                                   id="edit-account-number" placeholder="Account Number" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Select Bank</label>
                                            <select class="form-control" name="bank_name_id" id="edit-bank-name"
                                                    required>
                                                @foreach($banks as $bank)
                                                    <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a bank.</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Select Currency</label>
                                            <select class="form-control" name="currency_id" id="edit-currency-id"
                                                    required>
                                                @foreach($currencies as $currency)
                                                    <option value="{{$currency->id}}">{{$currency->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Please select a currency.</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Initial Balance</label>
                                            <input type="number" class="form-control" name="balance" id="edit-balance"
                                                   placeholder="Initial Balance" step="0.01" required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
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
                                            Update Bank Account
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
                                    <h3>Are you sure to delete this account ?</h3>
                                    <div class="text-secondary"> This action can not be undone.
                                    </div>
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
                                <th class="text-center">Account Holders Name</th>
                                <th class="text-center">Bank Name</th>
                                <th class="text-center">Account Number</th>
                                <th class="text-center">Available balance</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @foreach($bankAccounts as $account)

                                <tr id="row-{{$account->id}}">
                                    <td class="text-center">{{ $account->account_name }}</td>
                                    <td class="text-center">{{ $account->bank->bank_name }}</td>
                                    <td class="text-center">{{ $account->account_number }}</td>
                                    <td class="text-center">{{ $account->balance }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-info edit-account-btn"
                                                data-account-id="{{ $account->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                                                <path
                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                                                <path d="M16 5l3 3"/>
                                            </svg>
                                            Edit
                                        </button>
                                        <button class="btn btn-danger delete-btn" data-id="{{ $account->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                 stroke-linecap="round" stroke-linejoin="round"
                                                 class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M4 7l16 0"/>
                                                <path d="M10 11l0 6"/>
                                                <path d="M14 11l0 6"/>
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </td>

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
@endsection

@section('js')
    <script>
        "use strict";
        $(document).ready(function () {


            $('#add-bank-account-form').submit(function (e) {
                e.preventDefault();
                let form = $(this);
                $.ajax({
                    url: "{{ route('accounts.store') }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function (response) {
                        location.reload(); // Refresh to see the new account
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;
                        form.find('.invalid-feedback').hide();

                        if (errors.bank_name_id) {
                            $('select[name="bank_name_id"]').next('.invalid-feedback').text(errors.bank_name_id[0]).show();
                        }
                        if (errors.currency_id) {
                            $('select[name="currency_id"]').next('.invalid-feedback').text(errors.currency_id[0]).show();
                        }
                        console.log("Error adding account:", xhr);
                    }
                });
            });


            $(document).on('click', '.edit-account-btn', function () {
                const accountId = $(this).data('account-id');

                $.ajax({
                    url: `/accounts/edit/${accountId}`, // Correct route to fetch account details
                    type: 'GET',
                    success: function (response) {
                        // Check if the response contains the account data
                        if (response.data) {
                            // Populate form fields with the account details
                            $('#edit-account-name').val(response.data.account_name);
                            $('#edit-account-number').val(response.data.account_number);
                            $('#edit-bank-name').val(response.data.bank_name_id);
                            $('#edit-currency-id').val(response.data.currency_id);
                            $('#edit-balance').val(response.data.balance);

                            // Update the form action URL to include the account ID for update
                            $('#edit-bank-account-form').attr('action', `/accounts/update/${accountId}`);

                            // Open the modal for editing
                            $('#modal-edit-account').modal('show');
                        } else {
                            alert("Error fetching account details.");
                        }
                    },
                    error: function (xhr) {
                        console.log("Error fetching account details:", xhr);
                        alert("Error fetching account details.");
                    }
                });
            });


            $('#edit-bank-account-form').submit(function (e) {
                e.preventDefault();
                let form = $(this);
                let formAction = form.attr('action');

                $.ajax({
                    url: formAction,
                    type: "POST",
                    data: form.serialize(),
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;
                        form.find('.invalid-feedback').hide();

                        // Display errors if there are any
                        if (errors.account_name) {
                            $('input[name="account_name"]').next('.invalid-feedback').text(errors.account_name[0]).show();
                        }
                        if (errors.account_number) {
                            $('input[name="account_number"]').next('.invalid-feedback').text(errors.account_number[0]).show();
                        }
                        if (errors.bank_name_id) {
                            $('select[name="bank_name_id"]').next('.invalid-feedback').text(errors.bank_name_id[0]).show();
                        }
                        if (errors.currency_id) {
                            $('select[name="currency_id"]').next('.invalid-feedback').text(errors.currency_id[0]).show();
                        }
                        if (errors.balance) {
                            $('input[name="balance"]').next('.invalid-feedback').text(errors.balance[0]).show();
                        }
                        console.log("Error updating account:", xhr);
                    }
                });
            });


            let deleteAccountId;


            $(document).on('click', '.delete-btn', function () {
                deleteAccountId = $(this).data('id');
                $('#modal-delete').modal('show');
            });


            $('#confirm-delete').on('click', function () {
                $.ajax({
                    url: "{{ url('accounts/destroy') }}/" + deleteAccountId, // Laravel route
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}" // Send CSRF token for security
                    },
                    success: function (response) {
                        $('#modal-delete').modal('hide'); // Hide modal
                        $('#row-' + deleteAccountId).remove();
                    },
                    error: function (xhr) {
                        console.log("Error deleting category:", xhr);
                    }
                });
            });

        });


    </script>

@endsection
