<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\BudgetCategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetCategory query()
 * @property int $budget_id
 * @property int $category_id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetCategory whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BudgetCategory whereCategoryId($value)
 * @mixin \Eloquent
 */
class BudgetCategory extends Model
{
    /** @use HasFactory<\Database\Factories\BudgetCategoryFactory> */
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'budget_category';

}
