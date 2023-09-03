<?php

namespace App\Services;

use App\Models\User;
use App\Traits\Generics;
use RealRashid\SweetAlert\Facades\Alert;

class ElectricityService {
    use Generics;

    private $meterNo = [
        'prepaid' => '1111111111111',
        'postpaid' => '1010101010101'
    ];

    private $isTest = true;


    function verify(array $data){
        $response = VtPassService::authorize()->post('merchant-verify', [
            'billersCode' => env('TEST_MODE') ? $this->meterNo[$data['type']] : $data['meter_no'],
            'serviceID' => $data['service_id'],
            'type' => $data['type']
        ]);
        
        $data = VtPassService::response($response);
        return $data['content'];
    }

    function purchase($user, $data){
        $response = VtPassService::authorize()->post('pay', [
            'request_id' => $data['request_id'],
            'serviceID' => $data['service_id'],
            'billersCode' => env('TEST_MODE') ? $this->meterNo[$data['type']] : $data['meter_no'],
            'variation_code' => $data['type'],
            'amount' => $data['amount'],
            'phone' => $user->phone
        ]);

        $data = VtPassService::response($response);
        return $data;
    }

    function payWithWallet(){
        
    }


}