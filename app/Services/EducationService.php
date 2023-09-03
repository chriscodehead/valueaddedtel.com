<?php 

namespace App\Services;

use RealRashid\SweetAlert\Facades\Alert;

class EducationService {

    public $services = [
        'waec' => 'waec',
        'jamb' => 'jamb',
        'waec-registration' => 'waecReg'
    ];

    private function mapContent ($data) {
        return [
            'name' => $data['ServiceName'],
            'variations' => $data['varations'],
            'service' => $data['serviceID']
        ];
    }

    function load($service){
        $response = VtPassService::authorize()->get("/service-variations?serviceID=$service");
        //if($service == 'waec-registration') dd($response->json());
      	$data = VtPassService::response($response);
        return $this->mapContent($data['content']);
    }
    
    function purchase($data){
        $response = VtPassService::authorize()->post("/pay", $data);
        return VtPassService::response($response);
        
    }

    function jamb($data){
        $response = VtPassService::authorize()->post('merchant-verify', $data);
        $data = VtPassService::response($response);
        
        if(!key_exists('Customer_Name', $data['content'])) {
            Alert::error('Invalid Customer Name');
            abort(back());
        }

        return true;
    }

    function waec($data){
        
    }

    function waecReg($data){

    }

}