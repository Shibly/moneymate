<?php

namespace App\Providers;

use App\Repositories\Contracts\BankRepositoryInterface;
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
    }

}
