<?php

namespace App\Providers;

use App\Repositories\Contracts\AccountTransferRepositoryInterface;
use App\Repositories\Contracts\BankAccountRepositoryInterface;
use App\Repositories\Contracts\BankRepositoryInterface;
use App\Repositories\Eloquent\AccountTransferRepository;
use App\Repositories\Eloquent\BankAccountRepository;
use App\Repositories\Eloquent\BankRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{


    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(BankRepositoryInterface::class, BankRepository::class);
        $this->app->bind(BankAccountRepositoryInterface::class, BankAccountRepository::class);
        $this->app->bind(AccountTransferRepositoryInterface::class, AccountTransferRepository::class);
    }

}
