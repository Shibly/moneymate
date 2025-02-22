<?php

namespace App\Providers;

use App\Repositories\Contracts\AccountTransferRepositoryInterface;
use App\Repositories\Contracts\BankAccountRepositoryInterface;
use App\Repositories\Contracts\BankRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\CurrencyRepositoryInterface;
use App\Repositories\Contracts\DebtLoanRepositoryInterface;
use App\Repositories\Contracts\IncomeRepositoryInterface;
use App\Repositories\Eloquent\AccountTransferRepository;
use App\Repositories\Eloquent\BankAccountRepository;
use App\Repositories\Eloquent\BankRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\CurrencyRepository;
use App\Repositories\Eloquent\DebtLoanRepository;
use App\Repositories\Eloquent\IncomeRepository;
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
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CurrencyRepositoryInterface::class, CurrencyRepository::class);
        $this->app->bind(IncomeRepositoryInterface::class, IncomeRepository::class);
        $this->app->bind(DebtLoanRepositoryInterface::class, DebtLoanRepository::class);
    }

}
