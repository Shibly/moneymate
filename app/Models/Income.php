<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\IncomeFactory factory($count = null, $state = [])
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
    /** @use HasFactory<\Database\Factories\IncomeFactory> */
    use HasFactory;
}
