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
 * @method static \Database\Factories\BorrowFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrow newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrow newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrow query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrow whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrow whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrow whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrow whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrow whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrow whereDebtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrow whereExchangeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrow whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrow whereUsdAmount($value)
 * @property int $user_id
 * @property-read \App\Models\BankAccount|null $account
 * @property-read \App\Models\Currency|null $currency
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Borrow whereUserId($value)
 * @mixin \Eloquent
 */
class Borrow extends Model
{
    /** @use HasFactory<\Database\Factories\BorrowFactory> */
    use HasFactory;

    protected $table = 'borrows';
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
