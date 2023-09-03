<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['monnify_charge', 'bank_name', 'account_no', 'account_name', 'phone_number', 'whatsapp_number', 'telegram_link', 'facebook_link', 'office_address', 'enable_paystack', 'withdrawal_threshold'];

}
