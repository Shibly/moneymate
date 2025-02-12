<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $from_account_id
 * @property int $to_account_id
 * @property string $amount
 * @property string $exchange_amount
 * @property string $usd_amount
 * @property string $transfer_date
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\AccountTransferFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountTransfer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountTransfer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountTransfer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountTransfer whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountTransfer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountTransfer whereExchangeAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountTransfer whereFromAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountTransfer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountTransfer whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountTransfer whereToAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountTransfer whereTransferDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountTransfer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountTransfer whereUsdAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AccountTransfer whereUserId($value)
 * @mixin \Eloquent
 */
class AccountTransfer extends Model
{
    /** @use HasFactory<\Database\Factories\AccountTransferFactory> */
    use HasFactory;
}
