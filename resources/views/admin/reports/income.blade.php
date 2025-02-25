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
                    <form method="GET" action="{{ route('income.report.index') }}" class="row g-2 align-items-end">
                        <div class="col-auto">

                            <label for="start_date" class="form-label">Start Date</label>
                            <div class="input-icon mb-2">
                                <input class="form-control datepicker" name="start_date"
                                       placeholder="Start Date"
                                        value="{{ request('start_date') }}"/>
                                <span class="input-icon-addon"><x-tabler-calendar/></span>
                            </div>

                        </div>

                        <div class="col-auto">
                            <label for="end_date" class="form-label">End Date</label>
                            <div class="input-icon mb-2">
                                <input class="form-control datepicker" name="end_date"
                                       placeholder="End Date"
                                        value="{{ request('end_date') }}"/>
                                <span class="input-icon-addon"><x-tabler-calendar/></span>
                            </div>
                        </div>


                        <div class="col-auto ms-auto">
                            <button type="submit" class="btn btn-primary">
                                Filter
                            </button>

                            <a href="{{ route('income.report.export', ['start_date' => request('start_date'),'end_date' => request('end_date')]) }}"
                               class="btn btn-success">
                                Download Excel
                            </a>
                        </div>
                    </form>
                </div>


                <div class="card-body p-0">
                    <div id="table-default" class="table-responsive">
                        <table class="table datatable table-striped table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Account</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Income Date</th>
                                <th class="text-center">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($incomes as $income)
                                <tr>
                                    <td class="text-center">{{ $income->bankAccount->account_number }}</td>
                                    <td class="text-center">{{ optional($income->category)->name }}</td>
                                    <td class="text-center">{{ number_format($income->amount, 2) }} {{$income->currency->name}}</td>
                                    <td class="text-center">{{ $income->income_date }}</td>
                                    <td class="text-center">{{ $income->description }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        No incomes found.
                                    </td>
                                </tr>
                            @endforelse
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
@endsection
