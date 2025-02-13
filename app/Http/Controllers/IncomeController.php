<?php


namespace App\Http\Controllers;

use App\Http\Requests\StoreIncomeRequest;
use App\Http\Requests\UpdateIncomeRequest;
use App\Models\Income;
use App\Services\IncomeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class IncomeController extends Controller
{
    protected IncomeService $incomeService;

    public function __construct(IncomeService $incomeService)
    {
        $this->incomeService = $incomeService;
    }

    /**
     * @param StoreIncomeRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function store(StoreIncomeRequest $request): JsonResponse
    {
        $income = $this->incomeService->create($request);
        return response()->json(['income' => $income], 201);
    }

    /**
     * @param UpdateIncomeRequest $request
     * @param Income $income
     * @return JsonResponse
     * @throws \Exception
     */
    public function update(UpdateIncomeRequest $request, Income $income): JsonResponse
    {
        $updatedIncome = $this->incomeService->update($request, $income);
        return response()->json(['income' => $updatedIncome]);
    }


    /**
     * @param Income $income
     * @return Response
     * @throws \Exception
     */
    public function destroy(Income $income): Response
    {
        $this->incomeService->delete($income);
        return response()->noContent();
    }

    /**
     * @param Income $income
     * @return JsonResponse
     */
    public function show(Income $income): JsonResponse
    {
        return response()->json(['income' => $income]);
    }
}
