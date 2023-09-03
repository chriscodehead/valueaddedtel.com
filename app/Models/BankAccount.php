<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [ 'user_id', 'accountReference', 'bvn', 'accountName', 'bankCode', 'bankName', 'accountNumber', 'reservationReference', 'status'];





}
