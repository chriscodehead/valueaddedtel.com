<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['service', 'transaction_id', 'amount', 'code', 'pin'];

    function transaction(){
        return $this->hasOne(VtuHistory::class, 'transaction_id');
    }
}
