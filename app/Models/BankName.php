<?php

namespace App\Models;

use Database\Factories\BankNameFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property string $bank_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read TFactory|null $use_factory
 * @method static BankNameFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankName newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankName newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankName query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankName whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankName whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankName whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankName whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BankName whereUserId($value)
 * @mixin \Eloquent
 */
class BankName extends Model
{
    /** @use HasFactory<BankNameFactory> */
    use HasFactory;

    protected $table = 'bank_names';
    protected $guarded = [];

}
