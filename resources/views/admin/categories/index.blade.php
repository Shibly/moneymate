@extends('layout.master')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Income and Expense Categories
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
                                    <h5 class="modal-title">Add New Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>


                                <form id="add-category-form" action="{{ route('categories.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Category Name</label>
                                            <input type="text" class="form-control" name="name"
                                                   placeholder="Category Name" required>
                                            <!-- Error message will be dynamically injected here -->
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Category Type</label>
                                                    <select name="type" class="form-select" required>
                                                        <option value="income" selected>Income</option>
                                                        <option value="expense">Expense</option>
                                                    </select>
                                                    <!-- Error message will be dynamically injected here -->
                                                </div>
                                            </div>
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
                                                 stroke-linejoin="round" class="icon icon-2">
                                                <path d="M12 5l0 14"/>
                                                <path d="M5 12l14 0"/>
                                            </svg>
                                            Add New Category
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
                                    <h5 class="modal-title">Edit Category</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form id="edit-category-form">
                                    @csrf
                                    <input type="hidden" name="id" id="edit-category-id">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Category Name</label>
                                            <input type="text" class="form-control" name="name" id="edit-category-name"
                                                   required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Category Type</label>
                                            <select name="type" class="form-select" id="edit-category-type" required>
                                                <option value="income">Income</option>
                                                <option value="expense">Expense</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary">Update Category</button>
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
                                    <h3>Are you sure to delete this category ?</h3>
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
            <div class="card-body p-0">
                <div id="table-default" class="table-responsive">
                    <table class="table datatable table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">Category Name</th>
                            <th class="text-center">Category Type</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody class="table-tbody">
                        @foreach($categories as $category)

                            <tr id="row-{{$category->id}}">
                                <td class="text-center">{{ $category->name }}</td>
                                <td class="text-center">{{ $category->type }}</td>
                                <td class="text-center">
                                    <button class="btn btn-info edit-btn" data-id="{{ $category->id }}">
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
                                    <button class="btn btn-danger delete-btn" data-id="{{ $category->id }}">
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
@endsection

@section('js')
    <script>
        $(document).ready(function () {

            $('#add-category-form').submit(function (e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('categories.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (response) {

                        location.reload();
                    },
                    error: function (xhr) {
                        $('.invalid-feedback').remove();
                        $('.alert.alert-danger').remove();

                        let errors = xhr.responseJSON.errors;

                        if (errors.name) {
                            $('input[name="name"]').after('<div class="alert alert-danger d-block mt-2">' + errors.name[0] + '</div>');
                        }

                        if (errors.type) {
                            $('select[name="type"]').after('<div class="alert alert-danger d-block mt-2">' + errors.type[0] + '</div>');
                        }


                        console.log("Error adding category:", xhr);
                    }
                });
            });


            $(document).on('click', '.edit-btn', function () {
                let categoryId = $(this).data('id'); // Get category ID from button

                $.ajax({
                    url: "{{ url('categories/edit') }}/" + categoryId, // Corrected route URL
                    type: "GET",
                    success: function (data) {
                        // Populate modal fields with received data
                        $('#edit-category-id').val(data.id);
                        $('#edit-category-name').val(data.name);
                        $('#edit-category-type').val(data.type);


                        $('#modal-edit').modal('show');
                    },
                    error: function (xhr) {
                        console.log("Error fetching category data:", xhr);
                    }
                });
            });


            $('#edit-category-form').submit(function (e) {
                e.preventDefault();

                let categoryId = $('#edit-category-id').val();
                $('.invalid-feedback').remove();

                $.ajax({
                    url: "{{ url('categories/update') }}/" + categoryId,
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr) {
                        let errors = xhr.responseJSON.errors;

                        // Handle validation errors
                        if (errors.name) {
                            $('input[name="name"]').after('<div class="alert alert-danger invalid-feedback d-block mt-2">' + errors.name[0] + '</div>');
                        }

                        if (errors.type) {
                            $('select[name="type"]').after('<div class="alert alert-danger invalid-feedback d-block mt-2">' + errors.type[0] + '</div>');
                        }

                        console.log("Error updating category:", xhr);
                    }
                });
            });


        });

        let deleteCategoryId;


        $(document).on('click', '.delete-btn', function () {
            deleteCategoryId = $(this).data('id');
            $('#modal-delete').modal('show');
        });


        $('#confirm-delete').click(function () {
            $.ajax({
                url: "{{ url('categories/destroy') }}/" + deleteCategoryId,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    $('#modal-delete').modal('hide');
                    $('#row-' + deleteCategoryId).remove();
                },
                error: function (xhr) {
                    console.log("Error deleting category:", xhr);
                }
            });
        });

    </script>

@endsection
