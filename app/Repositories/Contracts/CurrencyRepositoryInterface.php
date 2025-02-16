<?php

namespace App\Repositories\Contracts;

use App\Models\Currency;

interface CurrencyRepositoryInterface
{

    public function getAll();
    public function create(array $data): Currency;

    public function update(Currency $currency, array $data): bool;

    public function delete(Currency $currency): bool;

    public function findById(int $id): ?Currency;

    public function unsetDefaultCurrency(): void;

    public function setFirstDefaultCurrency(): void;

    public function countDefaultCurrency(): int;
}
