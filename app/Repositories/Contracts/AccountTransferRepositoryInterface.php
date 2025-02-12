<?php

namespace App\Repositories\Contracts;
use App\Models\AccountTransfer;
interface AccountTransferRepositoryInterface
{
    public function create(array $data): AccountTransfer;
}
