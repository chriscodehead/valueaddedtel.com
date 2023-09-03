<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class LegitDataService {

    function init($header){
        return Http::baseUrl(env('VTU_SERVICE_URL'))->withHeaders($header);
    }

    function authorize(){
        $res = Http::baseUrl(env('VTU_SERVICE_URL'))->withHeaders([
            'Authorization' => "Basic ".base64_encode(env('VTU_SERVICE_TOKEN'))
            ])->get('user');
        $data = $res->json();

        if(!$res->ok()){
            Alert::error('Your Transaction could not be completed!');
            return abort(back());
        } 

        if($data['status'] !== 'success' || !$data['status']){
            Alert::error($data['message']);
            return abort(back());
        } 

        return $data['AccessToken'];
    }

    /**
     * @return array{ 
     * network: string, request-id: string, amount: integer,
     * quantity: integer, status: string, message: string, card_name: string, system: string,
     * serial: string, pin: string, load_pin: string, check_balance: string
     * }
     */
    function recharge($name, $network, $quantity, $type){
        $token = $this->authorize();

        $res = $this->init([
            'Authorization' => "Token $token",
            'Content-Type: application/json'
        ])->post('recharge', [
            'network' => $network,
            'plan_type' => $type,
            'quantity' => $quantity,
            'card_name' => $name,
        ]);

        $data = $res->json();

        if(!$res->ok()){
            Alert::error('Your Transaction could not be completed!');
            return abort(back());
        } 

        if($data['status'] !== 'success' || !$data['status']){
            Alert::error($data['message']);
            return abort(back());
        } 

        return $data;
    }
    
}