<?php

namespace App\Models;

use Database\Factories\IncomeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $account_id
 * @property int $category_id
 * @property int|null $currency_id
 * @property string $amount
 * @property string|null $reference
 * @property string|null $income_date
 * @property string|null $note
 * @property string|null $attachment
 * @property string $exchange_amount
 * @property string $usd_amount
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read TFactory|null $use_factory
 * @method static IncomeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereExchangeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereIncomeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereUsdAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Income whereUserId($value)
 * @mixin \Eloquent
 */
class Income extends Model
{
    /** @use HasFactory<IncomeFactory> */
    use HasFactory;

    protected $table = 'incomes';
    protected $primaryKey = 'id';
    protected $guarded = [];


    public function person(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * @return BelongsTo
     */
    public function bankAccount (): BelongsTo
    {
        return $this->belongsTo(BankAccount::class, 'account_id', 'id');
    }


    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }
}
