<?php

namespace App\Repositories\Eloquent;

use App\Models\AccountTransfer;
use App\Repositories\Contracts\AccountTransferRepositoryInterface;

class AccountTransferRepository implements AccountTransferRepositoryInterface
{

    public function create(array $data): AccountTransfer
    {
        return AccountTransfer::create($data);
    }
}
