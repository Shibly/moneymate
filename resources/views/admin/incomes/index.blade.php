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
                            {{get_translation('add_new')}}
                        </a>
                    </div>
                    <div class="modal modal-blur fade" id="add-new-income" tabindex="-1" role="dialog"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{get_translation('add_new_income')}}</h5>
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
                                                <label class="form-label">{{get_translation('income_category')}}</label>
                                                <select class="form-control select2" name="category_id" required>
                                                    <option value="">{{get_translation('select_an_option')}}</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label
                                                    class="form-label">{{get_translation('select_bank_account')}}</label>
                                                <select class="form-control select2" name="account_id" required>
                                                    <option value="">{{get_translation('select_an_option')}}</option>
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


                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{get_translation('currency')}}</label>
                                                <select class="form-control select2" name="currency_id" required>
                                                    <option value="">{{get_translation('select_an_option')}}</option>
                                                    @foreach($currencies as $currency)
                                                        <option value="{{$currency->id}}">{{$currency->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{get_translation('amount')}}</label>
                                                <input type="number" class="form-control" name="amount"
                                                       placeholder="{{get_translation('amount')}}" required>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{get_translation('reference')}}</label>
                                                <input type="text" class="form-control" name="reference"
                                                       placeholder="{{get_translation('reference')}}">
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{get_translation('description')}}</label>
                                                <textarea class="form-control" name="description" rows="3"
                                                          placeholder="{{get_translation('description')}}"></textarea>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{get_translation('note')}}</label>
                                                <textarea class="form-control" name="note" rows="3"
                                                          placeholder="{{get_translation('note')}}"></textarea>
                                            </div>


                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">{{get_translation('add_attachment')}}</label>
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
                                            {{get_translation('cancel')}}
                                        </button>
                                        <button type="submit"
                                                class="btn btn-primary">{{get_translation('submit')}}</button>
                                    </div>
                                </form>
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
                                    <h3>{{get_translation('are_you_sure_to_delete_this')}}</h3>
                                    <div class="text-secondary"> {{get_translation('this_action_can_not_be_undone')}}
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
                                <th class="text-center">{{get_translation('amount')}}</th>
                                <th class="text-center">{{get_translation('account_number')}}</th>
                                <th class="text-center">{{get_translation('category')}}</th>
                                <th class="text-center">{{get_translation('description')}}</th>
                                <th class="text-center">{{get_translation('attachment')}}</th>
                                <th class="text-center">{{get_translation('income_date')}}</th>
                                <th class="text-center">{{get_translation('reference')}}</th>
                                <th class="text-center">{{get_translation('action')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table-tbody">
                            @foreach($incomes as $income)

                                <tr id="row-{{$income->id}}">
                                    <td class="text-center">{{ $income->amount }} {{$income->currency ? $income->currency->name : ''}}</td>
                                    <td class="text-center">{{ $income->bankAccount->account_number }}</td>
                                    <td class="text-center">{{ $income->category->name }}</td>
                                    <td class="text-center">{{ $income->description }}</td>
                                    <td class="text-center">
                                        @if($income->attachment)
                                            <a class=""
                                               href="{{route('download.attachment',$income->attachment)}}">
                                                <x-tabler-download/>
                                            </a>
                                        @else
                                            {{get_translation('no_attachment')}}
                                        @endif
                                    </td>
                                    <td class="text-center">{{$income->income_date}}</td>
                                    <td class="text-center">{{$income->reference}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-danger delete-btn" data-id="{{ $income->id }}">
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
    <script src="{{ asset('/js/calendar.js') }}"></script>
    <script>

        "use strict";
        $(document).ready(function () {
            function initializeTomSelect() {
                $(".select2").each(function () {
                    new TomSelect(this, {
                        create: false,
                        onChange: function () {
                            this.blur();
                        }
                    });
                });
            }


            initializeTomSelect();


            $('#add-new-income').on('shown.bs.modal', function () {
                setTimeout(function () {
                    initializeTomSelect();
                }, 100);
            });

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
                            text: "{{get_translation('the_income_record_has_been_deleted_successfully')}}",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                    },
                    error: function (xhr) {
                        console.log("Error deleting Income:", xhr);
                        Swal.fire({
                            title: "Error!",
                            text: "Something went wrong. Please try again.",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                });
            });
        });


    </script>

@endsection
