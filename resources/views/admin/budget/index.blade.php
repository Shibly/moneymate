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
                            Add New Budget
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
                                <th class="text-center">Budget Name</th>
                                <th class="text-center">Proposed Amount</th>
                                <th class="text-center">Updated Budget Amount</th>
                                <th class="text-center">Budget Start Date</th>
                                <th class="text-center">Budget End Date</th>
                                <th class="text-center" width="25%">Action</th>
                            </tr>
                            </thead>
                            <tbody class="table-tbody">

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
                    <h5 class="modal-title">Add Budget</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{route('budget.store')}}" method="POST" id="addBudget">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div>
                                    <label class="form-label">Budget Name: <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="budget_name" placeholder="Budget Name">
                                    <div class="text-danger pt-2 budget_name"></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Select Currency: <span
                                            class="text-danger">*</span></label>
                                    <select name="currency_id" class="form-control">
                                        <option value="">Select Currency</option>
                                        @foreach($currencies as $currency)
                                            <option value="{{$currency->id}}">{{$currency->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger mt-2 currency_id"></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Budget Amount: <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="amount" placeholder="Budget Amount">
                                    <div class="text-danger pt-2 amount"></div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">

                                <div>
                                    <label class="form-label">Expense Category: <span
                                            class="text-danger">*</span></label>
                                    <select name="category_id[]" class="form-control" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger mt-2 category_id"></div>
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Start Date: <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="start_date"
                                           placeholder="Start Date">
                                    <div class="text-danger pt-2 start_date"></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">End Date: <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="end_date"
                                           placeholder="End Date">
                                    <div class="text-danger pt-2 end_date"></div>
                                </div>

                            </div>
                        </div>
                        <div class="logical-error d-none alert alert-danger"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit Budget</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal modal-blur fade" id="editBudgetModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Budget</h5>
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
                    <h3>Are you sure to delete this budget?</h3>
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

            $('#addBudget').submit(function (e) {
                e.preventDefault();

                $("#addBudgetModal .logical-error").addClass('d-none');

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
                        } else if (xhr.status === 400) {
                            var err_response = JSON.parse(xhr.responseText);
                            $("#addBudgetModal .logical-error").removeClass('d-none').show().text(err_response.message);
                        } else {
                            alert("Something went wrong. Please try again.");
                        }
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
