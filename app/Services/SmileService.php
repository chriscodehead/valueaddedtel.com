<?php

namespace App\Services;

class SmileService {

    function plans(){
        $res = VtPassService::authorize()->get('service-variations?serviceID=smile-direct');
        $data = VtPassService::response($res);
        return $data['content']['varations'];
    }

    function verify($email, $serviceId){
        $res = VtPassService::authorize()->post('merchant-verify/smile/email', [
            'billersCode' => $email,
            'serviceID' => 'smile-direct'
        ]);
        $data = VtPassService::response($res)['content'];
        return $data;
    }

    function purchase($data, $route){
        $response = VtPassService::authorize()->post('pay', $data);
        $content = VtPassService::response($response, $route);
        return $content['content'];    
    }

}