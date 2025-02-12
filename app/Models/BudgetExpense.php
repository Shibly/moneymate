<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @method static \Database\Factories\BudgetExpenseFactory factory($count = null, $state = [])
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
 * @mixin \Eloquent
 */
class BudgetExpense extends Model
{
    /** @use HasFactory<\Database\Factories\BudgetExpenseFactory> */
    use HasFactory;
}
