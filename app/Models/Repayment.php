<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property string $amount
 * @property string $exchange_amount
 * @property string $usd_amount
 * @property string|null $date
 * @property int $debt_id
 * @property int $account_id
 * @property int|null $currency_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BankAccount $account
 * @property-read \App\Models\Currency|null $currency
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repayment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repayment whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repayment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repayment whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repayment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repayment whereDebtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repayment whereExchangeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repayment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Repayment whereUsdAmount($value)
 * @mixin \Eloquent
 */
class Repayment extends Model
{
    protected $table = 'repayments';
    protected $primaryKey = 'id';
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class, 'account_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }
}
