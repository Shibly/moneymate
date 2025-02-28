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
                           data-bs-target="#addBudgetModal">
                            <x-tabler-plus/>
                            {{get_translation('add_new_budget')}}
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
                                <th class="text-center">{{get_translation('budget_name')}}</th>
                                <th class="text-center">{{get_translation('budget_amount')}}</th>
                                <th class="text-center">{{get_translation('updated_budget_amount')}}</th>
                                <th class="text-center">{{get_translation('budget_start_date')}}</th>
                                <th class="text-center">{{get_translation('budget_end_date')}}</th>
                                <th class="text-center" width="25%">{{get_translation('action')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @foreach($budgets as $budget)
                                <tr>
                                    <td>{{$budget->budget_name}}</td>
                                    <td>{{$budget->currency ? $budget->currency->name : ''}} {{$budget->amount}}</td>
                                    <td>{{$budget->currency ? $budget->currency->name : ''}} {{$budget->updated_amount}}</td>
                                    <td>{{\Carbon\Carbon::parse($budget->start_date)->format("d/m/Y")}}</td>
                                    <td>{{\Carbon\Carbon::parse($budget->end_date)->format("d/m/Y")}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-info edit-btn" data-id="{{ $budget->id }}">
                                            <x-tabler-edit/>
                                            Edit
                                        </button>
                                        <button class="btn btn-danger delete-btn" data-id="{{ $budget->id }}">
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


    <div class="modal modal-blur fade" id="addBudgetModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{get_translation('add_budget')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{route('budget.store')}}" method="POST" id="addBudget">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div>
                                    <label class="form-label">{{get_translation('budget_name')}}: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="budget_name"
                                           placeholder="Budget Name">
                                    <div class="text-danger pt-2 budget_name"></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{get_translation('select_category')}}: <span
                                            class="text-danger">*</span></label>
                                    <select name="currency_id" class="form-control">
                                        <option value="">{{get_translation('select_currency')}}</option>
                                        @foreach($currencies as $currency)
                                            <option value="{{$currency->id}}">{{$currency->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger mt-2 currency_id"></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{get_translation('budget_amount')}}: <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="amount"
                                           placeholder="{{get_translation('budget_amount')}}">
                                    <div class="text-danger pt-2 amount"></div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">

                                <div>
                                    <label class="form-label">{{get_translation('expense_categories')}}: <span
                                            class="text-danger">*</span></label>
                                    <select name="categories[]" class="form-control select2" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger mt-2 categories"></div>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">{{get_translation('start_date')}}: <span
                                            class="text-danger">*</span></label>

                                    <div class="input-icon mb-2">
                                        <input class="form-control datepicker" name="start_date"
                                               placeholder="{{get_translation('start_date')}}"
                                               value=""/>
                                        <span class="input-icon-addon"><x-tabler-calendar/></span>
                                    </div>
                                    <div class="text-danger pt-2 start_date"></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">{{get_translation('end_date')}}: <span
                                            class="text-danger">*</span></label>
                                    <div class="input-icon mb-2">
                                        <input class="form-control datepicker" name="end_date"
                                               placeholder="{{get_translation('end_date')}}"
                                               value=""/>
                                        <span class="input-icon-addon"><x-tabler-calendar/></span>
                                    </div>
                                    <div class="text-danger pt-2 end_date"></div>
                                </div>

                            </div>
                        </div>
                        <div class="logical-error d-none alert alert-danger"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">{{get_translation('cancel')}}</button>
                        <button type="submit"
                                class="btn btn-primary action-button">{{get_translation('submit')}}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="editBudgetModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{get_translation('edit_budget')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="edit-form"></div>

            </div>
        </div>
    </div>



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
                    <h3>{{get_translation('are_you_sure_you_want_to_delete_this')}}</h3>
                    <div class="text-secondary">{{get_translation('ths_action_can_not_be_undone')}}</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">{{get_translation('cancel')}}
                    </button>
                    <button type="button" class="btn btn-danger" id="confirm-delete">{{get_translation('yes_delete')}}
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/calendar.js') }}"></script>
    <script>
        "use strict";

        $(document).ready(function () {
            let select = new TomSelect(".select2", {
                create: false,
                placeholder: "",
                onChange: function () {
                    this.blur();
                }
            });


            $('#addBudget').submit(function (e) {
                e.preventDefault();

                $("#addBudgetModal .logical-error").addClass('d-none');
                let submitButton = $('button[type="submit"]');
                submitButton.prop('disabled', true).text('{{get_translation('submitting')}}');


                var form = $(this);
                var url = form.attr('action');
                const formData = new FormData(form[0]);

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            var err_response = JSON.parse(xhr.responseText);
                            $.each(err_response.errors, function (key, value) {
                                $("#addBudgetModal ." + key).text(value);
                            });
                        } else {
                            var err_response = JSON.parse(xhr.responseText);
                            $("#addBudgetModal .logical-error").removeClass('d-none').show().text(err_response.message);
                        }

                        $("#addBudgetModal .action-button").attr('disabled', false);
                    },
                    complete: function () {
                        submitButton.prop('disabled', false).text('{{get_translation('submit')}}');
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });

            $(document).on('click', '.edit-btn', function () {
                let budgetId = $(this).data('id');
                $.ajax({
                    url: "{{ url('budget/edit') }}/" + budgetId,
                    type: "GET",
                    success: function (data) {
                        $('#editBudgetModal .edit-form').html(data);
                        $('#editBudgetModal').modal('show');
                    },
                    error: function (xhr) {
                        console.log("Error fetching bank data:", xhr);
                    }
                });
            });


            $(document).on('submit', '#updateBudget', function (e) {
                e.preventDefault();
                let submitButton = $('button[type="submit"]');
                submitButton.prop('disabled', true).text('{{get_translation('updating')}}');
                $("#editBudgetModal .logical-error").addClass('d-none');
                $("#editBudgetModal .action-button").attr('disabled', true);

                var form = $(this);
                var url = form.attr('action');
                const formData = new FormData(form[0]);

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    success: function (response) {
                        location.reload();
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            var err_response = JSON.parse(xhr.responseText);
                            $.each(err_response.errors, function (key, value) {
                                $("#editBudgetModal ." + key).text(value);
                            });
                        } else {
                            var err_response = JSON.parse(xhr.responseText);
                            $("#editBudgetModal .logical-error")
                                .removeClass('d-none')
                                .show()
                                .text(err_response.message);
                        }
                        $("#editBudgetModal .action-button").attr('disabled', false);
                    },
                    complete: function () {
                        submitButton.prop('disabled', false).text('{{get_translation('update')}}');
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });


            let deletedId;
            $(document).on('click', '.delete-btn', function () {
                deletedId = $(this).data('id');
                $('#modal-delete').modal('show');
            });

            $('#confirm-delete').click(function () {
                $.ajax({
                    url: "{{ url('budget/destroy') }}/" + deletedId,
                    type: "GET",
                    success: function (response) {
                        $('#modal-delete').modal('hide');
                        $('#row-' + deletedId).remove();
                        location.reload();
                    },
                    error: function (xhr) {
                        console.log("Error deleting expense:", xhr);
                    }
                });
            });

        });


    </script>
@endsection
