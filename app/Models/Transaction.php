<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, Uuids;

    protected $guarded = ['id'];
  
  /** Scope */
    function scopeWithdrawals($query){
        $query->where('trans_type', config('constants.trans_types.withdraw'));
    }
    
    function scopeDeposits($query){
        $query->where('trans_type', config('constants.trans_types.deposit'));
    }

    function scopePointValue($query){
        $query->where('purpose', "PV");
    }

    function scopeCashback($query){
        $query->where('payment_method', 'cashback');
    }

    function scopeCompleted($query){
        $query->where('status', 'success')->orWhere('status', 'completed');
    }

    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
