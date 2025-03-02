<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\LendFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lend newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lend newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lend query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lend whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lend whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lend whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lend whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lend whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lend whereDebtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lend whereExchangeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lend whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lend whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lend whereUsdAmount($value)
 * @property int $user_id
 * @property-read \App\Models\BankAccount|null $account
 * @property-read \App\Models\Currency|null $currency
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lend whereUserId($value)
 * @mixin \Eloquent
 */
class Lend extends Model
{
    /** @use HasFactory<\Database\Factories\LendFactory> */
    use HasFactory;

    protected $table = 'lends';
    protected $primaryKey = 'id';
    protected $guarded = [];

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
