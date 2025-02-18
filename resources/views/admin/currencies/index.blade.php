@extends('layout.master')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Manage Currencies
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary btn-5 d-none d-sm-inline-block" data-bs-toggle="modal"
                           data-bs-target="#modal-report">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="icon icon-2">
                                <path d="M12 5l0 14"/>
                                <path d="M5 12l14 0"/>
                            </svg>
                            Add New
                        </a>
                    </div>
                    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Currency</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>

                                <form action="{{ route('currencies.store') }}" method="POST">
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
                                        <button type="button" class="btn btn-link link-secondary"
                                                data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                 stroke-linejoin="round"
                                                 class="icon icon-2">
                                                <path d="M12 5l0 14"/>
                                                <path d="M5 12l14 0"/>
                                            </svg>
                                            Add New Currency
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
                                        <button type="submit" class="btn btn-primary">Update Currency</button>
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
                                        <button class="btn btn-danger delete-btn" data-id="{{ $currency->id }}">
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
        $(document).ready(function () {
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
                let currencyId = $('#edit-currency-id').val();

                $.ajax({
                    url: "{{ url('currencies/update') }}/" + currencyId,
                    type: "POST", // Use PUT method for updates
                    data: $(this).serialize(),
                    success: function (response) {
                        $('#modal-edit').modal('hide');
                        location.reload();
                    },
                    error: function (xhr) {
                        console.log("Error updating currency:", xhr);
                    }
                });
            });


            let deleteCurrencyId;


            $(document).on('click', '.delete-btn', function () {
                deleteCurrencyId = $(this).data('id'); // Get currency ID from button
                console.log("Delete button clicked. Currency ID:", deleteCurrencyId); // Debugging

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
