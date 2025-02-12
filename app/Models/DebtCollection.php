<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $amount
 * @property string $exchange_amount
 * @property string|null $date
 * @property int $debt_id
 * @property int $account_id
 * @property int|null $currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\DebtCollectionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DebtCollection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DebtCollection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DebtCollection query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DebtCollection whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DebtCollection whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DebtCollection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DebtCollection whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DebtCollection whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DebtCollection whereDebtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DebtCollection whereExchangeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DebtCollection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DebtCollection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DebtCollection extends Model
{
    /** @use HasFactory<\Database\Factories\DebtCollectionFactory> */
    use HasFactory;
}
