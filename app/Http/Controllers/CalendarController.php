<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;

class CalendarController extends Controller
{


    /**
     * @return Factory|View|Application|object
     */
    public function index()
    {
        $title = "Income and Expense Calendar";
        $activeMenu = "calendar";
        return view('admin.calendar.index', compact('title', 'activeMenu'));
    }


    /**
     * @return JsonResponse
     */

    public function getData(): JsonResponse
    {
        $incomes = collect(Income::with(['bankAccount', 'category', 'currency'])
            ->get()
            ->map(function ($income) {
                return [
                    'id' => 'income-' . $income->id,
                    'title' => 'Income - ' . $income->category->name,
                    'start' => $income->income_date,
                    'color' => $income->category->category_color ?? '#206bc4',
                    'description' => $income->description,
                    'amount' => $income->amount . ' ' . optional($income->currency)->name,
                    'currency' => optional($income->currency)->name ?? 'N/A',
                    'account' => optional($income->bankAccount)->account_number ?? 'N/A',
                    'note' => $income->note,
                    'reference' => $income->reference,
                    'attachment' => $income->attachment,
                    'type' => 'income'
                ];
            })
        );
        $expenses = collect(Expense::with(['bankAccount', 'category', 'currency'])
            ->get()
            ->map(function ($expense) {
                return [
                    'id' => 'expense-' . $expense->id,
                    'title' => 'Expense - ' . $expense->category->name,
                    'start' => $expense->expense_date,
                    'color' => $expense->category->category_color ?? '#d63939',
                    'description' => $expense->description,
                    'amount' => $expense->amount . ' ' . optional($expense->currency)->name,
                    'currency' => optional($expense->currency)->name ?? 'N/A',
                    'account' => optional($expense->bankAccount)->account_number ?? 'N/A',
                    'note' => $expense->note,
                    'reference' => $expense->reference,
                    'attachment' => $expense->attachment,
                    'type' => 'expense'
                ];
            })
        );
        if ($incomes->isEmpty() && $expenses->isEmpty()) {
            return response()->json([]);
        }
        $data = $incomes->merge($expenses);
        if ($incomes->isEmpty()) {
            $data = $expenses;
        }
        if ($expenses->isEmpty()) {
            $data = $incomes;
        }
        return response()->json($data);
    }
}
