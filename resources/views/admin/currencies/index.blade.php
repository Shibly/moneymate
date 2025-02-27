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
                        <a href="#" class="btn btn-primary btn-5 d-none d-sm-inline-block" data-bs-toggle="modal"
                           data-bs-target="#modal-create-currency">
                            <x-tabler-currency-dollar/>
                            Add New
                        </a>
                    </div>
                    <div class="modal modal-blur fade" id="modal-create-currency" tabindex="-1" role="dialog"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Currency</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>

                                <form id="create-currency" action="" method="POST">
                                    @csrf

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Currency Name or Symbol</label>
                                            <input type="text" class="form-control" name="name"
                                                   placeholder="Currency Name" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Exchange Rate</label>
                                            <input type="number" class="form-control" name="exchange_rate"
                                                   placeholder="Exchange Rate" step="0.01" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Is Default</label>
                                            <select name="is_default" class="form-select" required>
                                                <option value="yes">Yes</option>
                                                <option value="no" selected>No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            {{get_translation('submit')}}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Currency</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form id="edit-currency-form">
                                    @csrf
                                    <input type="hidden" name="id" id="edit-currency-id">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Currency Name or Symbol</label>
                                            <input type="text" class="form-control" name="name" id="edit-currency-name"
                                                   required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Exchange Rate</label>
                                            <input type="number" class="form-control" name="exchange_rate"
                                                   id="edit-currency-exchange-rate"
                                                   step="0.01" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Is Default</label>
                                            <select name="is_default" class="form-select" id="edit-currency-is-base"
                                                    required>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            {{get_translation('submit')}}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="modal modal-blur fade" id="modal-delete" tabindex="-1" role="dialog">
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
                                    <h3>Are you sure to delete this currency ?</h3>
                                    <div class="text-secondary">Do you really want to delete the currency ? This action
                                        can not be undone.
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
            <div class="alert alert-info">
                <span class="badge bg-blue-lt">Tip:</span>
                Please note that USD serves as the base currency. You may add additional currencies as
                needed, but ensure that you provide the exchange rate relative to USD.
            </div>
            <div class="card">
                <div class="card-body p-0">
                    <div id="table-default" class="table-responsive">
                        <table class="table datatable table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Currency</th>
                                <th class="text-center">Exchange Rate</th>
                                <th class="text-center">Is Default</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @foreach($currencies as $currency)
                                <tr id="row-{{$currency->id}}">
                                    <td class="text-center">{{ $currency->name }}</td>
                                    <td class="text-center">{{ $currency->exchange_rate }}</td>
                                    <td class="text-center">{{ ucfirst($currency->is_default) }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-info edit-btn" data-id="{{ $currency->id }}">
                                            <x-tabler-edit/>
                                            Edit
                                        </button>
                                        @if($currency->id != 3)
                                            <button class="btn btn-danger delete-btn" data-id="{{ $currency->id }}">
                                                <x-tabler-trash/>
                                                Delete
                                            </button>
                                        @endif
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

            $('#create-currency').on('submit', function (e) {
                e.preventDefault();
                let submitButton = $('button[type="submit"]');
                submitButton.prop('disabled', true).text('Submitting...');

                $('.text-danger').remove();
                $.ajax({
                    url: "{{ route('currencies.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#create-currency')[0].reset();
                        $('#modal-create').modal('hide');
                        location.reload();
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            for (let key in errors) {
                                let inputField = $('[name="' + key + '"]');
                                inputField.after('<div class="text-danger pt-2">' + errors[key][0] + '</div>');
                            }
                        } else {
                            console.log("Error creating currency:", xhr);
                        }
                    },
                    complete: function () {
                        submitButton.prop('disabled', false).text('{{get_translation('submit')}}');
                    }
                });
            });


            // Handle edit button click
            $(document).on('click', '.edit-btn', function () {
                let currencyId = $(this).data('id'); // Get currency ID from button

                $.ajax({
                    url: "{{ url('currencies/edit') }}/" + currencyId, // Corrected route URL
                    type: "GET",
                    success: function (data) {
                        $('#edit-currency-id').val(data.id);
                        $('#edit-currency-name').val(data.name);
                        $('#edit-currency-exchange-rate').val(data.exchange_rate);
                        $('#edit-currency-is-base').val(data.is_base); // Ensure correct value is selected

                        $('#modal-edit').modal('show');
                    },
                    error: function (xhr) {
                        console.log("Error fetching currency data:", xhr);
                    }
                });
            });

            // Handle edit form submission
            $('#edit-currency-form').on('submit', function (e) {
                e.preventDefault();
                let submitButton = $('button[type="submit"]');
                submitButton.prop('disabled', true).text('Submitting...');

                let currencyId = $('#edit-currency-id').val();

                $.ajax({
                    url: "{{ url('currencies/update') }}/" + currencyId,
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#modal-edit').modal('hide');
                        location.reload();
                    },
                    error: function (xhr) {
                        console.log("Error updating currency:", xhr);
                    },
                    complete: function () {
                        submitButton.prop('disabled', false).text('{{get_translation('submit')}}');
                    }
                });
            });


            let deleteCurrencyId;


            $(document).on('click', '.delete-btn', function () {
                deleteCurrencyId = $(this).data('id'); // Get currency ID from button
                //console.log("Delete button clicked. Currency ID:", deleteCurrencyId); // Debugging

                if (!deleteCurrencyId) {
                    console.error("No currency ID found!");
                    return;
                }

                $('#modal-delete').modal('show'); // Show confirmation modal
            });


            $('#confirm-delete').on('click', function () {
                $.ajax({
                    url: "{{ url('currencies/destroy') }}/" + deleteCurrencyId,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        $('#modal-delete').modal('hide');
                        $('#row-' + deleteCurrencyId).remove();
                        Swal.fire({
                            title: "Deleted!",
                            text: "Currency has been deleted",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                    },
                    error: function (xhr) {
                        console.log("Error deleting currency:", xhr);
                    }
                });
            });
        });

    </script>

@endsection
