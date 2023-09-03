<?php

namespace App\Services;

use App\Models\User;
use App\Traits\Generics;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class MonnifyService {
    use Generics;
    private $authKey;
    public $api;
    public $token;

    public function __construct()
    {
        $authKey = env('MONNIFY_API_KEY') . ":" . env('MONNIFY_SECRET_KEY');
        $this->api = Http::withHeaders([
            "Authorization" => "Basic ".base64_encode($authKey),
        ])->baseUrl(env('MONNIFY_URL'));
    }

    private function login(){
        $response = $this->api->post('/api/v1/auth/login');
        if(!$response->ok()) throw new \Exception("The response was not successful");
        $data = jsonify($response->json());
        if(!$data->requestSuccessful || $data->responseMessage !== 'success') throw new \Exception("The response was not successful");

        $this->token = $data->responseBody->accessToken;

        return $this->api;
    }

    private function authorize(){
        return $this->login()->withHeaders([
                        "Authorization" => "Bearer ".$this->token,
                        "Content-Type" => 'application/json'
                    ]);
    }

    function reserve(User $user, $preferredBanks = null){
        $this->authorize();
        $reference = $this->createUniqueID('bank_accounts', 'accountReference');

        $response = Http::withHeaders([
            "Authorization" => "Bearer ".$this->token,
            "Content-Type" => 'application/json'
        ])->post(env('MONNIFY_URL').'/api/v2/bank-transfer/reserved-accounts', [
            "accountReference" => $reference,
            "accountName" => $user->full_name,
            "currencyCode" => "NGN",
            "contractCode" => env('MONNIFY_CONTRACT_CODE'),
            "customerEmail" => $user->email,
            "customerName" => $user->full_name,
            "getAllAvailableBanks" => false,
            'preferredBanks' => $preferredBanks ?? config('constants.preferred_banks')
        ]);

        if(!$response->ok()) throw new \Exception("The request was not successful");
        $data = jsonify($response->json());

        if(!$data->requestSuccessful || $data->responseMessage !== 'success') status(false, "The response was not successful");

        $responseBody = $data->responseBody;

        $accounts = $this->mapAccounts($responseBody);
        
        return status(true, '', $accounts);
    }

    function mapAccounts ($data){
        $accounts = $data->accounts;

        return array_map(function($item) use($data){
            return [
                "accountReference" => $data->accountReference,
                "accountName" => $item->accountName,
                "bankCode" => $item->bankCode,
                "bankName" => $item->bankName,
                "accountNumber" => $item->accountNumber,
                'reservationReference' => $data->reservationReference
            ];
        }, $accounts);
    }

    function account($reference){
        $response = $this->authorize()->get('/api/v1/bank-transfer/reserved-accounts/'.$reference);

        if(!$response->ok()) throw new \Exception("The response was not successful");
        $data = jsonify($response->json());

        if(!$data->requestSuccessful || $data->responseMessage !== 'success') throw new \Exception("The response was not successful");

        $responseBody = $data->responseBody;
        return status(true, "", $responseBody);
    }

    function verifyBVN($user, $data){
        $response = $this->authorize()->post('api/v1/vas/bvn-details-match', [
            "bvn" => $data['bvn'],
            "name" => $user->full_name,
            "dateOfBirth" => $data['dateOfBirth'],
            "mobileNo" => $user->phone
        ]);

        if(!$response->ok()) dd($response->object());
        if(!$response->ok()) throw new \Exception("The response was not successful");
        $data = jsonify($response->json());

        if(!$data->requestSuccessful || $data->responseMessage !== 'success') throw new \Exception("The response was not successful");

        $responseBody = $data->responseBody;
        $matchStatus = $responseBody->name->matchStatus;

        if($matchStatus === 'NO_MATCH') return status(false, "The name did not match!");

        if($matchStatus === 'PARTIAL_MATCH' || $matchStatus === 'FULL_MATCH') return status(true, "Matched");
    }
}
