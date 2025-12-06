<?php

namespace App\Models;

use App\Enums\WalletTransaction as WalletTransactionEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'wallet_id',
        'type',
        'amount',
        'transactionable_id',
        'transactionable_type',
        'transaction_number',
        'payment_card_id',
    ];

    protected $casts = [
        'amount' => 'float',
    ];

    public function getTypeTextAttribute()
    {
        return __('admin.wallet_type_' . WalletTransactionEnum::nameFor($this->type));
    }


    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'wallet_id', 'id');
    }


    public function transactionable()
    {
        return $this->morphTo();
    }
}
