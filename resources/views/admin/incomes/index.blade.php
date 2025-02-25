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
                           data-bs-target="#add-new-income">
                            <x-tabler-octagon-plus/>
                            Add New
                        </a>
                    </div>
                    <div class="modal modal-blur fade" id="add-new-income" tabindex="-1" role="dialog"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add New Income</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>

                                <form id="add-income-form" action="{{ route('incomes.store') }}" method="POST"
                                      enctype="multipart/form-data">

                                    @csrf

                                    <div class="modal-body">
                                        <div class="row">
                                            <!-- Income Category (First Column) -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Income Category</label>
                                                <select class="form-control" name="category_id" required>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Select Bank Account (First Column) -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Select Bank Account</label>
                                                <select class="form-control" name="account_id" required>
                                                    @foreach($bankAccounts as $bankAccount)
                                                        <option value="{{$bankAccount->id}}">
                                                            {{$bankAccount->bank->bank_name}}
                                                            - {{$bankAccount->account_number}} -
                                                            Balance
                                                            ({{$bankAccount->currency->name ?? ''}} {{$bankAccount->balance}}
                                                            )
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Currency (Second Column) -->
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Currency</label>
                                                <select class="form-control" name="currency_id" required>
                                                    @foreach($currencies as $currency)
                                                        <option value="{{$currency->id}}">{{$currency->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Amount</label>
                                                <input type="number" class="form-control" name="amount"
                                                       placeholder="Amount" required>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Reference</label>
                                                <input type="text" class="form-control" name="reference"
                                                       placeholder="Income Reference">
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control" name="description" rows="3"
                                                          placeholder="Description"></textarea>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Note</label>
                                                <textarea class="form-control" name="note" rows="3"
                                                          placeholder="Additional Note"></textarea>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Add Attachment</label>
                                                <input type="file" class="form-control" name="attachment">
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Date</label>
                                                <div class="input-icon mb-2">
                                                    <input class="form-control datepicker" name="income_date"
                                                           placeholder="Select a date"
                                                           value="" required/>
                                                    <span class="input-icon-addon"><x-tabler-calendar/></span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <x-tabler-octagon-plus/>
                                            Submit
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
                                    <h5 class="modal-title">Edit Bank Name</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <form id="edit-bank-name-form">
                                    @csrf
                                    <input type="hidden" name="id" id="edit-category-id">

                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Bank Name</label>
                                            <input type="text" class="form-control" name="bank_name" id="edit-bank-name"
                                                   required>
                                        </div>
                                        <div id="edit-form-errors" class="d-none"></div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel
                                        </button>
                                        <button type="submit" class="btn btn-primary">Update Bank</button>
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
                                    <h3>Are you sure to delete this income ?</h3>
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
                                <th class="text-center">Amount</th>
                                <th class="text-center">Receiving Account Number</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Attachment</th>
                                <th class="text-center">Income Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @foreach($incomes as $income)

                                <tr id="row-{{$income->id}}">
                                    <td class="text-center">{{ $income->amount }}</td>
                                    <td class="text-center">{{ $income->bankAccount->account_number }}</td>
                                    <td class="text-center">{{ $income->category->name }}</td>
                                    <td class="text-center">{{ $income->description }}</td>
                                    <td class="text-center">
                                        @if($income->attachment)
                                            <a class="badge bg-blue text-blue-fg"
                                               href="{{route('download.attachment',$income->attachment)}}">
                                                <x-tabler-download/>
                                                Download Attachment</a>
                                        @else
                                            No Attachment
                                        @endif
                                    </td>
                                    <td class="text-center">{{$income->income_date}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-danger delete-btn" data-id="{{ $income->id }}">
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
    <script src="{{ asset('public/js/calendar.js') }}"></script>
    <script>
        "use strict";
        let deleteIncomeId;


        $(document).on('click', '.delete-btn', function () {
            deleteIncomeId = $(this).data('id');
            $('#modal-delete').modal('show');
        });

        $('#confirm-delete').on('click', function () {
            $.ajax({
                url: "{{ url('incomes/destroy') }}/" + deleteIncomeId,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    $('#modal-delete').modal('hide');
                    $('#row-' + deleteIncomeId).remove();
                    Swal.fire({
                        title: "Deleted!",
                        text: "The income record has been successfully deleted.",
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                },
                error: function (xhr) {
                    console.log("Error deleting category:", xhr);
                    Swal.fire({
                        title: "Error!",
                        text: "Something went wrong. Please try again.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            });
        });

    </script>

@endsection
