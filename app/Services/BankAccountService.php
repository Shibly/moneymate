<?php

namespace App\Services;

use App\Http\Requests\StoreBankAccountRequest;
use App\Http\Requests\UpdateBankAccountRequest;
use App\Models\BankAccount;
use App\Repositories\Eloquent\BankAccountRepository;
use Illuminate\Database\Eloquent\Collection;

class BankAccountService
{

    private BankAccountRepository $bankAccountRepository;

    public function __construct(BankAccountRepository $bankAccountRepository)
    {
        $this->bankAccountRepository = $bankAccountRepository;
    }

    public function store(StoreBankAccountRequest $request): BankAccount
    {
        $data = $request->validated();
        return $this->bankAccountRepository->create($data);
    }

    public function update(BankAccount $bankAccount, UpdateBankAccountRequest $request): BankAccount
    {
        $data = $request->validated();
        return $this->bankAccountRepository->update($bankAccount, $data);
    }


    public function delete(BankAccount $bankAccount): void
    {
        $this->bankAccountRepository->delete($bankAccount);
    }


    /**
     * @param int $userId
     * @return Collection
     */
    public function getByUserId(int $userId): Collection
    {
        return $this->bankAccountRepository->findByUserId($userId);
    }


    /**
     * @param int $bankNameId
     * @return Collection
     */
    public function getByBankNameId(int $bankNameId): Collection
    {
        return $this->bankAccountRepository->findByBankNameId($bankNameId);
    }


}
