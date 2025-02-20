<?php

namespace App\Repositories\Eloquent;

use App\Models\AccountTransfer;
use App\Repositories\Contracts\AccountTransferRepositoryInterface;
use Illuminate\Support\Collection;

class AccountTransferRepository implements AccountTransferRepositoryInterface
{

    /**
     * @return Collection
     */

    public function getAll(): Collection
    {
        return AccountTransfer::where('user_id', auth()->id())
            ->with(['toAccount', 'fromAccount'])
            ->get();
    }
    public function create(array $data): AccountTransfer
    {
        return AccountTransfer::create($data);
    }
}
