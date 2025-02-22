<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property int $account_id
 * @property int|null $currency_id
 * @property string $type
 * @property string $amount
 * @property string $exchange_amount
 * @property string $usd_amount
 * @property string $person
 * @property string $date
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\DebtFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereExchangeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt wherePerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereUsdAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Debt whereUserId($value)
 * @mixin \Eloquent
 */
class Debt extends Model
{
    /** @use HasFactory<\Database\Factories\DebtFactory> */
    use HasFactory;

    protected $table = 'debts';
    protected $primaryKey = 'id';
    protected $guarded = [];


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function lends(): HasMany
    {
        return $this->hasMany(Lend::class);
    }


    /**
     * @return HasMany
     */
    public function borrows(): HasMany
    {
        return $this->hasMany(Borrow::class);
    }


    /**
     * @return HasMany
     */
    public function debtsCollections(): HasMany
    {
        return $this->hasMany(DebtCollection::class);
    }


    /**
     * @return BelongsTo
     */
    public function accounts(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class, 'account_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function bankAccount(): BelongsTo
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
