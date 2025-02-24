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
                           data-bs-target="#modal-report">
                            <x-tabler-building-bank/>
                            {{get_translation('add_new')}}
                        </a>
                    </div>
                    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{get_translation('add_new_bank')}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>


                                <form id="add-bank-form" action="{{ route('banks.store') }}" method="POST">
                                    @csrf

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">{{get_translation('bank_name')}}</label>
                                            <input type="text" class="form-control" name="bank_name"
                                                   placeholder="{{get_translation('bank_name')}}" required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">
                                            {{get_translation('cancel')}}
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <x-tabler-building-bank/>
                                            {{get_translation('add_new_bank')}}
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
                                    <h5 class="modal-title">{{get_translation('edit_bank_name')}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <form id="edit-bank-name-form">
                                    @csrf
                                    <input type="hidden" name="id" id="edit-category-id">

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">{{get_translation('bank_name')}}</label>
                                            <input type="text" class="form-control" name="bank_name" id="edit-bank-name"
                                                   required>
                                        </div>
                                        <div id="edit-form-errors" class="d-none"></div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">{{get_translation('cancel')}}
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <x-tabler-building-bank/>
                                            {{get_translation('update')}}
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
                                    <h3>{{get_translation('are_you_sure_to_delete_this')}}</h3>
                                    <div class="text-secondary"> {{get_translation('this_action_can_not_be_undone')}}
                                    </div>
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
                            @foreach($banks as $bank)

                                <tr id="row-{{$bank->id}}">
                                    <td class="text-center">{{ $bank->bank_name }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-info edit-btn" data-id="{{ $bank->id }}">
                                            <x-tabler-edit/>
                                            Edit
                                        </button>
                                        <button class="btn btn-danger delete-btn" data-id="{{ $bank->id }}">
                                            <x-tabler-trash/>
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

            // Add Bank - form submission
            $('#add-bank-form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('banks.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        location.reload(); // Reload the page if the bank is successfully added
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) { // Validation error
                            let errors = xhr.responseJSON.errors;
                            let errorHtml = '';

                            // Display each error for bank_name
                            if (errors.bank_name) {
                                errorHtml += '<div class="alert alert-danger">' + errors.bank_name[0] + '</div>';
                            }

                            // Show errors in the modal
                            $('#modal-report .modal-body').prepend(errorHtml);
                        } else {
                            console.log("Error adding bank:", xhr);
                            toastr.error("Something went wrong. Please try again.");
                        }
                    }
                });
            });


            $(document).on('click', '.edit-btn', function () {
                let categoryId = $(this).data('id');

                $.ajax({
                    url: "{{ url('banks/edit') }}/" + categoryId,
                    type: "GET",
                    success: function (data) {
                        $('#edit-category-id').val(data.id);
                        $('#edit-bank-name').val(data.bank_name);
                        $('#modal-edit').modal('show');
                    },
                    error: function (xhr) {
                        console.log("Error fetching bank data:", xhr);
                    }
                });
            });


            $('#edit-bank-name-form').submit(function (e) {
                e.preventDefault();
                let categoryId = $('#edit-category-id').val();

                $.ajax({
                    url: "{{ url('banks/update') }}/" + categoryId,
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorHtml = '<span class="badge bg-red-lt">';

                            $.each(errors, function (key, value) {
                                errorHtml += value[0]; // Display each error
                            });

                            errorHtml += '</span>';

                            $('#edit-form-errors').html(errorHtml).removeClass('d-none'); // Show errors
                        } else {
                            console.log("Error updating bank:", xhr);
                            toastr.error("Something went wrong. Please try again.");
                        }
                    }
                });
            });


        });

        let deleteBankId;


        $(document).on('click', '.delete-btn', function () {
            deleteBankId = $(this).data('id');
            $('#modal-delete').modal('show');
        });


        $('#confirm-delete').on('click', function () {
            $.ajax({
                url: "{{ url('banks/destroy') }}/" + deleteBankId,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    $('#modal-delete').modal('hide'); // Hide modal
                    $('#row-' + deleteBankId).remove();
                    Swal.fire({
                        title: "Deleted!",
                        text: "Bank has been deleted.",
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                },
                error: function (xhr) {
                    console.log("Error deleting category:", xhr);
                }
            });
        });

    </script>

@endsection
