<?php

namespace App\Services;

class ShowmaxService {

    function plans(){
        $res = VtPassService::authorize()->get('service-variations?serviceID=showmax');
        $data = VtPassService::response($res);
        return $data['content']['varations'];
    }

    function purchase($data, $route){
        $response = VtPassService::authorize()->post('pay', $data);
        $content = VtPassService::response($response, $route);
        return $content['content'];    
    }

}