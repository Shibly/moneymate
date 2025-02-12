<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $budget_name
 * @property int|null $currency_id
 * @property string $amount
 * @property string|null $updated_amount
 * @property string|null $usd_amount
 * @property string $start_date
 * @property string $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\BudgetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereBudgetName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereUpdatedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereUsdAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Budget whereUserId($value)
 * @mixin \Eloquent
 */
class Budget extends Model
{
    /** @use HasFactory<\Database\Factories\BudgetFactory> */
    use HasFactory;
}
