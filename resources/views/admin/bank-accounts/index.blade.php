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
                        <a href="{{ route('accounts.store') }}" class="btn btn-primary btn-5 d-none d-sm-inline-block"
                           data-bs-toggle="modal" data-bs-target="#modal-report">
                            <x-tabler-building-bank/>
                            {{get_translation('add_new')}}
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
                                            <label
                                                class="form-label">{{get_translation('account_holders_name')}}</label>
                                            <input type="text" class="form-control" name="account_name"
                                                   placeholder="Account Name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{get_translation('account_number')}}</label>
                                            <input type="text" class="form-control" name="account_number"
                                                   placeholder="{{get_translation('account_number')}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{get_translation('select_bank')}}</label>
                                            <select class="form-control" name="bank_name_id" required>
                                                @foreach($banks as $bank)
                                                    <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                                @endforeach
                                            </select>
                                            <div
                                                class="invalid-feedback">{{get_translation('please_select_a_bank')}}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{get_translation('select_currency')}}</label>
                                            <select class="form-control" name="currency_id" required>
                                                @foreach($currencies as $currency)
                                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                                @endforeach
                                            </select>
                                            <div
                                                class="invalid-feedback">{{get_translation('please_select_a_currency')}}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{get_translation('initial_balance')}}</label>
                                            <input type="number" class="form-control" name="balance"
                                                   placeholder="{{get_translation('initial_balance')}}" step="0.01"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">{{get_translation('cancel')}}
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <x-tabler-building-bank/>
                                            {{get_translation('add_new')}}
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
                                    <h5 class="modal-title">{{get_translation('edit_bank_account')}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>

                                <form id="edit-bank-account-form" action="{{ route('accounts.update', ':id') }}"
                                      method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">{{get_translation('account_holder_name')}}</label>
                                            <input type="text" class="form-control" name="account_name"
                                                   id="edit-account-name"
                                                   placeholder="{{get_translation('account_holder_name')}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{get_translation('account_number')}}</label>
                                            <input type="text" class="form-control" name="account_number"
                                                   id="edit-account-number"
                                                   placeholder="{{get_translation('account_number')}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{get_translation('select_bank')}}</label>
                                            <select class="form-control" name="bank_name_id" id="edit-bank-name"
                                                    required>
                                                @foreach($banks as $bank)
                                                    <option value="{{ $bank->id }}">{{ $bank->bank_name }}</option>
                                                @endforeach
                                            </select>
                                            <div
                                                class="invalid-feedback">{{get_translation('please_select_a_bank')}}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{get_translation('select_currency')}}</label>
                                            <select class="form-control" name="currency_id" id="edit-currency-id"
                                                    required>
                                                @foreach($currencies as $currency)
                                                    <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                                @endforeach
                                            </select>
                                            <div
                                                class="invalid-feedback">{{get_translation('please_select_a_currency')}}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{get_translation('initial_balance')}}</label>
                                            <input type="number" class="form-control" name="balance" id="edit-balance"
                                                   placeholder="{{get_translation('initial_balance')}}" step="0.01"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">{{get_translation('cancel')}}
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <x-tabler-building-bank/>
                                            {{get_translation('update_bank_account')}}
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
                                    <h5 class="modal-title">{{get_translation('conform_deletion')}}</h5>
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
                                    <h3>{{get_translation('are_you_sure_you_want_to_delete_this')}}</h3>
                                    <div
                                        class="text-secondary">{{get_translation('this_action_can_not_be_undone')}}</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{get_translation('cancel')}}
                                    </button>
                                    <button type="button" class="btn btn-danger"
                                            id="confirm-delete">{{get_translation('yes_delete')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page body for the table -->
    <div class="page-body">
        <div class="container-xl">
            <div class="alert alert-info">
                <span class="badge bg-blue-lt">{{get_translation('tips')}}</span>
                {{get_translation('before_creating_a_bank_account_please_ensure_your_bank_details_are_already_set_up')}}
                <a href="{{route('banks.index')}}" class="alert-link">{{get_translation('click_here_to_add_banks')}}</a>
            </div>
            <div class="card">
                <div class="card-body p-0">
                    <div id="table-default" class="table-responsive">
                        <table class="table datatable table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">{{get_translation('account_holders_name')}}</th>
                                <th class="text-center">{{get_translation('bank_name')}}</th>
                                <th class="text-center">{{get_translation('account_number')}}</th>
                                <th class="text-center">{{get_translation('available_balance')}}</th>
                                <th class="text-center">{{get_translation('action')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @foreach($bankAccounts as $account)
                                <tr id="row-{{ $account->id }}">
                                    <td class="text-center">{{ $account->account_name }}</td>
                                    <td class="text-center">{{ $account->bank->bank_name }}</td>
                                    <td class="text-center">{{ $account->account_number }}</td>
                                    <td class="text-center">{{ $account->balance }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-info edit-account-btn"
                                                data-account-id="{{ $account->id }}">
                                            <x-tabler-edit/>
                                            {{get_translation('edit')}}
                                        </button>
                                        <button class="btn btn-danger delete-btn" data-id="{{ $account->id }}">
                                            <x-tabler-trash/>
                                            {{get_translation('delete')}}
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
                    url: `/accounts/edit/${accountId}`,
                    type: 'GET',
                    success: function (response) {
                        if (response.data) {
                            $('#edit-account-name').val(response.data.account_name);
                            $('#edit-account-number').val(response.data.account_number);
                            $('#edit-bank-name').val(response.data.bank_name_id);
                            $('#edit-currency-id').val(response.data.currency_id);
                            $('#edit-balance').val(response.data.balance);
                            $('#edit-bank-account-form').attr('action', `/accounts/update/${accountId}`);
                            $('#modal-edit-account').modal('show');
                        } else {
                            alert("Error fetching account details.");
                        }
                    },
                    error: function (xhr) {
                        //console.log("Error fetching account details:", xhr);
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
                    url: "{{ url('accounts/destroy') }}/" + deleteAccountId,
                    type: "POST",
                    data: {_token: "{{ csrf_token() }}"},
                    success: function (response) {
                        $('#modal-delete').modal('hide');
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
