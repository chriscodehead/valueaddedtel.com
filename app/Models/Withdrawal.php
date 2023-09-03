<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['reference', 'user_id', 'amount', 'transfer_code', 'transaction_id', 'bank_name',  'account_no', 'status', 'account_status', 'account_name', 'method'];

    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
