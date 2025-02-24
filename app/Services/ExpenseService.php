<?php

namespace App\Services;

use App\Models\Expense;
use App\Repositories\Contracts\ExpenseInterface;
use Illuminate\Support\Collection;

class ExpenseService
{
    protected ExpenseInterface $expenseInterface;
    protected CurrencyConversionService $currencyConversionService;

    /**
     * @param ExpenseInterface $expenseInterface
     * @param CurrencyConversionService $currencyConversionService
     */
    public function __construct(ExpenseInterface $expenseInterface, CurrencyConversionService $currencyConversionService)
    {
        $this->expenseInterface = $expenseInterface;
        $this->currencyConversionService = $currencyConversionService;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->expenseInterface->all();
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function find(int $id): Collection
    {
        return $this->expenseInterface->find($id);
    }


    public function store($request)
    {
        $data = $request->validated();
        $data['attachment'] = $this->handleAttachmentUpload($request);
        return $this->expenseInterface->store($data);
    }


    /**
     * @param int $id
     * @return bool
     */

    public function delete(int $id): bool
    {
        return $this->expenseInterface->delete($id);
    }

    private function handleAttachmentUpload($request): ?string
    {
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $filename = time() . '.' . $attachment->getClientOriginalExtension();
            $attachment->storeAs('', $filename, 'local');
            return $filename;
        }
        return null;
    }

}
