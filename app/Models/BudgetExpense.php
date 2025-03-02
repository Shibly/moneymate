<?php

namespace App\Models;

use Database\Factories\BudgetExpenseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $budget_id
 * @property int $category_id
 * @property int|null $currency_id
 * @property int|null $expense_id
 * @property string $amount
 * @property string $usd_amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static BudgetExpenseFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetExpense newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetExpense newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetExpense query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetExpense whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetExpense whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetExpense whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetExpense whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetExpense whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetExpense whereExpenseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetExpense whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetExpense whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetExpense whereUsdAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetExpense whereUserId($value)
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\Currency|null $currency
 * @mixin \Eloquent
 */
class BudgetExpense extends Model
{
    /** @use HasFactory<BudgetExpenseFactory> */
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'budget_expenses';
    protected $guarded = [];


    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budget::class);
    }

    /**
     * @return BelongsTo
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

}
