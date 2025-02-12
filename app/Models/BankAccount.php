<?php

namespace App\Models;

use Database\Factories\BankAccountFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $bank_name_id
 * @property int|null $currency_id
 * @property string $account_name
 * @property string $account_number
 * @property string $balance
 * @property string $usd_balance
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static BankAccountFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount whereAccountName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount whereBankNameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount whereUsdBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankAccount whereUserId($value)
 * @mixin \Eloquent
 */
class BankAccount extends Model
{
    /** @use HasFactory<BankAccountFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_name_id',
        'currency_id',
        'account_name',
        'account_number',
        'balance',
        'usd_balance'];


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function bankName(): BelongsTo
    {
        return $this->belongsTo(BankName::class);
    }

}
