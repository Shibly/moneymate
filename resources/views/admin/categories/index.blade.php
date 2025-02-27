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
                           data-bs-target="#modal-category">
                            <x-tabler-category/>
                            {{get_translation('add_new')}}
                        </a>
                    </div>
                    <!-- Add New Category Modal -->
                    <div class="modal modal-blur fade" id="modal-category" tabindex="-1" role="dialog"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{get_translation('add_new_category')}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form id="add-category-form" action="{{ route('categories.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">{{get_translation('category_name')}}</label>
                                            <input type="text" class="form-control" name="name"
                                                   placeholder="{{get_translation('category_name')}}" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label
                                                        class="form-label">{{get_translation('category_type')}}</label>
                                                    <select name="type" class="form-select" required>
                                                        <option value="income" selected>Income</option>
                                                        <option value="expense">Expense</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label
                                                        class="form-label">{{get_translation('pick_a_color')}}</label>
                                                    <input name="category_color" type="color"
                                                           class="form-control form-control-color"
                                                           value="" title="Choose your color">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">
                                            {{get_translation('cancel')}}
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <x-tabler-category/>
                                            {{get_translation('add_new')}}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Category Modal -->
                    <div class="modal modal-blur fade" id="modal-edit" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{get_translation('edit_category')}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form id="edit-category-form">
                                    @csrf
                                    <input type="hidden" name="id" id="edit-category-id">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">{{get_translation('category_name')}}</label>
                                            <input type="text" class="form-control" name="name" id="edit-category-name"
                                                   required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">{{get_translation('category_type')}}</label>
                                            <select name="type" class="form-select" id="edit-category-type" required>
                                                <option value="income">Income</option>
                                                <option value="expense">Expense</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">{{get_translation('category_type')}}</label>
                                            <input name="category_color" type="color"
                                                   class="form-control form-control-color" id="edit-category-color"
                                                   value="" title="Choose your color">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">{{get_translation('cancel')}}
                                        </button>
                                        <button type="submit"
                                                class="btn btn-primary">{{get_translation('update')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade modal-blur" id="modal-delete" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{get_translation('confirm_deletion')}}</h5>
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
                                    <h3>Are you sure to delete this category?</h3>
                                    <div class="text-secondary">This action cannot be undone.</div>
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


    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-body">

                    <div class="alert alert-info">
                        <span class="badge bg-blue-lt">{{get_translation('tips')}}</span>
                        {{get_translation('categories_can_be_classified_as_either_income_or_expense_when_recording_your_income_or_expense_transactions_you_can_select_the_appropriate_category_to_ensure_accurate_financial_reporting_and_analysis')}}
                    </div>
                    <div id="table-default" class="table-responsive">
                        <table class="table datatable table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">{{get_translation('category_name')}}</th>
                                <th class="text-center">{{get_translation('category_type')}}</th>
                                <th class="text-center">{{get_translation('action')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @foreach($categories as $category)
                                <tr id="row-{{$category->id}}">
                                    <td class="text-center">{{ $category->name }}</td>
                                    <td class="text-center">
                                        @if ($category->type === 'expense')
                                            <span class="badge bg-red text-red-fg">{{ ucfirst($category->type) }}</span>
                                        @elseif ($category->type === 'income')
                                            <span class="badge bg-teal text-teal-fg">{{ ucfirst($category->type) }}</span>
                                        @else
                                            {{ ucfirst($category->type) }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-info edit-btn" data-id="{{ $category->id }}">
                                            <x-tabler-edit/>
                                            Edit
                                        </button>
                                        <button class="btn btn-danger delete-btn" data-id="{{ $category->id }}">
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
@endsection

@section('js')
    <script>
        "use strict";
        $(document).ready(function () {

            $('#add-category-form').submit(function (e) {
                e.preventDefault();

                let submitButton = $('button[type="submit"]');
                submitButton.prop('disabled', true).text('Submitting...');

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
                    },
                    complete: function () {
                        // submitButton.prop('disabled', false).text('Add Category');
                    }
                });
            });


            $(document).on('click', '.edit-btn', function () {
                let categoryId = $(this).data('id');
                $.ajax({
                    url: "{{ url('categories/edit') }}/" + categoryId,
                    type: "GET",
                    success: function (data) {
                        console.log(data);
                        $('#edit-category-id').val(data.id);
                        $('#edit-category-name').val(data.name);
                        $('#edit-category-type').val(data.type);
                        $('#edit-category-color').val(data.category_color);
                        $('#modal-edit').modal('show');
                    },
                    error: function (xhr) {
                        console.log("Error fetching category data:", xhr);
                    }
                });
            });

            $('#edit-category-form').submit(function (e) {
                e.preventDefault();
                let submitButton = $('button[type="submit"]');
                submitButton.prop('disabled', true).text('Submitting...');

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
                        if (errors.name) {
                            $('input[name="name"]').after('<div class="alert alert-danger invalid-feedback d-block mt-2">' + errors.name[0] + '</div>');
                        }
                        if (errors.type) {
                            $('select[name="type"]').after('<div class="alert alert-danger invalid-feedback d-block mt-2">' + errors.type[0] + '</div>');
                        }
                        console.log("Error updating category:", xhr);
                    },
                    complete: function () {
                        submitButton.prop('disabled', false).text('{{get_translation('submit')}}');
                    }
                });
            });

            let deleteCategoryId;
            $(document).on('click', '.delete-btn', function () {
                deleteCategoryId = $(this).data('id');
                $('#modal-delete').modal('show');
            });

            $('#confirm-delete').on("click", function () {
                $.ajax({
                    url: "{{ url('categories/destroy') }}/" + deleteCategoryId,
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        $('#modal-delete').modal('hide');
                        $('#row-' + deleteCategoryId).remove();
                        Swal.fire({
                            title: "Deleted!",
                            text: "{{get_translation('category_has_been_deleted')}}",
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
