<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RechargeCard extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['planId', 'user_id', 'network', 'denomination', 'data', 'transactionid', 'reference', 'quantity',  'amount'];

    protected $casts = [
        'data' => 'array'
    ];
}
