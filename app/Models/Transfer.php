<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['sender_id', 'receiver_id',  'amount', 'transaction_id', 'status'];

    function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }

    function receiver(){
        return $this->belongsTo(User::class, 'receiver_id');
    }

}
