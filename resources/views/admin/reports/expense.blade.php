@extends('layout.master')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        {{ $title }}
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">

            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('expense.report.index') }}" class="row g-2 align-items-end">
                        <div class="col-auto">
                            <label for="start_date" class="form-label">{{get_translation('start_date')}}</label>
                            <div class="input-icon mb-2">
                                <input class="form-control datepicker" name="start_date"
                                       placeholder="{{get_translation('start_date')}}"
                                       value="{{ request('start_date') }}" autocomplete="off"/>
                                <span class="input-icon-addon"><x-tabler-calendar/></span>
                            </div>
                        </div>

                        <div class="col-auto">
                            <label for="end_date" class="form-label">{{get_translation('end_date')}}</label>
                            <div class="input-icon mb-2">
                                <input class="form-control datepicker" name="end_date"
                                       placeholder="{{get_translation('end_date')}}"
                                       value="{{ request('end_date') }}" autocomplete="off" />
                                <span class="input-icon-addon"><x-tabler-calendar/></span>
                            </div>
                        </div>

                        <div class="col-auto mb-2">
                            <label for="categories" class="form-label">{{ get_translation('category') }}</label>
                            <select name="categories[]" class="form-control select2" multiple>
                                @foreach($expenseCategories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ in_array($category->id, old('categories', $selectedCategories ?? [])) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-auto ms-auto mb-2">
                            <a href="{{route('expense.report.index')}}" class="btn btn-instagram">
                                <x-tabler-restore/>
                                {{get_translation('reset')}}
                            </a>
                            <button type="submit" name="action_type" value="filter" class="btn btn-primary">
                                <x-tabler-filter/>
                                {{get_translation('filter')}}
                            </button>

{{--                            <a href="{{ route('expense.report.export', ['start_date' => request('start_date'),'end_date' => request('end_date')]) }}"--}}
{{--                               class="btn btn-success">--}}
{{--                                <x-tabler-file-type-xls/>--}}
{{--                                {{get_translation('download_excel')}}--}}
{{--                            </a>--}}

                            <button type="submit" name="action_type" value="export" class="btn btn-success">
                                <x-tabler-file-type-xls/>
                                {{get_translation('download_excel')}}
                            </button>

                        </div>
                    </form>

                </div>


                <div class="card-body p-3">
                    <div id="table-default" class="table-responsive">
                        <table class="table datatable table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">{{get_translation('account_number')}}</th>
                                <th class="text-center">{{get_translation('category')}}</th>
                                <th class="text-center">{{get_translation('amount')}}</th>
                                <th class="text-center">{{get_translation('expense_date')}}</th>
                                <th class="text-center">{{get_translation('reference')}}</th>
                                <th class="text-center">{{get_translation('description')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expenses as $expense)
                                <tr>
                                    <td class="text-center">{{ $expense->bankAccount->account_number }}</td>
                                    <td class="text-center">{{ optional($expense->category)->name }}</td>
                                    <td class="text-center">{{ number_format($expense->amount, 2) }} {{$expense->currency->name}}</td>
                                    <td class="text-center">{{ $expense->expense_date }}</td>
                                    <td class="text-center">{{ $expense->reference }}</td>
                                    <td class="text-center">{{ $expense->description }}</td>
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

        });
    </script>
@endsection
