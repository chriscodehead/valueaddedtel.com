<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Electricity extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['company_id', 'meter', 'meter_no', 'amount', 'transaction_id', 'purchased_code', 'units', 'address', 'customer_name'];

    function transaction(){
        return $this->hasOne(VtuHistory::class, 'transaction_id');
    }

    function company(){
        return $this->hasOne(ElectricityCompany::class, 'company_id');
    }

}
