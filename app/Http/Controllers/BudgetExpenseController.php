<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBudgetExpenseRequest;
use App\Http\Requests\UpdateBudgetExpenseRequest;
use App\Models\BudgetExpense;

class BudgetExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBudgetExpenseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(BudgetExpense $budgetExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BudgetExpense $budgetExpense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBudgetExpenseRequest $request, BudgetExpense $budgetExpense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BudgetExpense $budgetExpense)
    {
        //
    }
}
