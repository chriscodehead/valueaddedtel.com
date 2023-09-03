<?php

namespace App\Services;

class IntlAirtimeService {

    function countries(){
        $response = VtPassService::authorize()->get('get-international-airtime-countries');
        $content = VtPassService::response($response);
        return $content['content']['countries'];
    }

    function products($code) {
        $response = VtPassService::authorize()->get('get-international-airtime-product-types?code='.$code);
        $content = VtPassService::response($response);
        return $content['content'];
    }
    
    function operators($code, $productId) {
        $response = VtPassService::authorize()->get('get-international-airtime-operators?code='.$code.'&product_type_id='.$productId);
        $content = VtPassService::response($response);
        return $content['content'];
    }
    
    function services($operatorId, $productId){
        $response = VtPassService::authorize()->get('service-variations?serviceID=foreign-airtime&operator_id='.$operatorId.'&product_type_id='.$productId);
        $content = VtPassService::response($response);
        
        return $content['content'];    
    }

    function purchase($data){
        $response = VtPassService::authorize()->post('pay', $data);
        $content = VtPassService::response($response);
        return $content['content'];    
    }
}