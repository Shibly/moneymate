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
 * @mixin \Eloquent
 */
class BudgetCategory extends Model
{
    /** @use HasFactory<\Database\Factories\BudgetCategoryFactory> */
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'budget_category';

}
