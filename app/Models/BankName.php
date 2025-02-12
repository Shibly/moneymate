<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $user_id
 * @property string $bank_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\BankNameFactory factory($count = null, $state = [])
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
    /** @use HasFactory<\Database\Factories\BankNameFactory> */
    use HasFactory;


    protected $fillable = [
        'user_id',
        'bank_name',
    ];
}
