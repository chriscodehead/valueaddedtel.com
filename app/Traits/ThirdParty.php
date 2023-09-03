<?php

namespace App\Traits;

use App\Models\GeneralSetting;
use App\Services\VtPassService;
use Illuminate\Support\Facades\Http;

trait ThirdParty
{
    // a function that processes all POST request endpoints for flutterwave
    function flutterwavePostEndpoint($url, $postDetails)
    {
        $response = Http::acceptJson()
            ->withHeaders([
                'Content-Type' => "application/json",
                'Authorization' => "Bearer " . env('FLW_TEST_SK'),
            ])
            ->post($url, $postDetails);

        return $response;
    }

    // a function that processes all POST request endpoints for paystack
    function paystackPostEndpoint($url, $postDetails)
    {
        $response = Http::acceptJson()
            ->withHeaders([
                'Content-Type' => "application/json",
                'Authorization' => "Bearer " . env('PAYSTACK_TEST_SK'),
            ])
            ->post($url, $postDetails);

        return $response;
    }


    // a function that processes all GET request endpoints for flutterwave
    function flutterwaveGetEndpoint($url)
    {
        $response = Http::acceptJson()
            ->withHeaders([
                'Content-Type' => "application/json",
                'Authorization' => "Bearer " . env('FLW_TEST_SK'),
            ])
            ->get($url);

        return $response;
    }

    // a function that processes all GET request endpoints for flutterwave
    function paystackGetEndpoint($url)
    {
        $response = Http::acceptJson()
            ->withHeaders([
                'Content-Type' => "application/json",
                'Authorization' => "Bearer " . env('PAYSTACK_TEST_SK'),
            ])
            ->get($url);

        return $response;
    }

    function get_all_plans()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('DATA_SERVICE_URL') . '/api/data/plans',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . env('DATA_SERVICE_KEY')
            ),
        ));

        $response = curl_exec($curl);
        return json_decode($response, true);
    }

    function buy_data_sub($data)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('DATA_SERVICE_URL') . '/api/data/topup',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('id' => $data['plan_type'], 'pin' => env('DATA_SERVICE_PIN'), 'number' => $data['phone']),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . env('DATA_SERVICE_KEY')
            ),
        ));

        $response = curl_exec($curl);
        return json_decode($response, true);
    }

    function buy_airtime_sub($data)
    {
        $url = env('AIRTIME_SERVICE_URL') . '?userid=' . env('AIRTIME_SERVICE_USERID') . '&pass=' . env('AIRTIME_SERVICE_PASS') . '&network=' . $data['network'] . '&phone=' . $data['phone'] . '&amt=' . $data['amount'] . '&user_ref=' . $data['user_ref'] . '&jsn=json';
        $response = Http::acceptJson()
            ->withHeaders([
                'Content-Type' => "application/json",
            ])
            ->get($url);

        return $response;
    }

    function vtpassPostEndpoints($url, $postFields = null)
    {
        $curl = curl_init();
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HTTPHEADER => [
                //"Authorization: Basic " . env('VTPASS_TEST_KEY'),
                'api-key' => "6c9f1399b6dfeba54a6124b9bb63cc41",
                'secret-key' => "SK_425464649aa6d796e7cf2c11db24818d35bbd6f0ceb"
            ],
        ];
        curl_setopt_array($curl, $options);
        $curl_exec = curl_exec($curl);
        curl_close($curl);

        $response = $curl_exec;
        $result = json_decode($response, true);
        return $result;
    }


    function vtpassGetEndpoints($url)
    {
        $curl = curl_init();

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: Basic " . env('VTPASS_TEST_KEY')
            ],
        ];
        curl_setopt_array($curl, $options);
        $curl_exec = curl_exec($curl);
        curl_close($curl);

        $response = $curl_exec;
        $result = json_decode($response, true);

        return $result;
    }


    function verifyPhoneNumber($phone_number)
    {
        // set API Access Key
        $access_key = 'e4cd70d27e8f517429da0e8a7b929906';

        $ch = curl_init('http://apilayer.net/api/validate?access_key=' . $access_key . '&number=' . $phone_number . '&country_code=NG&format=1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($json, true);
        return $result;
    }

    function getVariationCodesFromVtPass($serviceID)
    {
        $url = env('VTPASS_TEST_URL') . '/service-variations?serviceID=' . $serviceID;
        return $this->vtpassGetEndpoints($url);
    }

    function verifyTVCardNumber($data, $deduceCode)
    {
        $postFields = array('serviceID' => $data['serviceID'], 'billersCode' => $data['billersCode']);
        $result = VtPassService::authorize()->post('/merchant-verify', $postFields);
        $result = VtPassService::response($result);
        
        if (array_key_exists('error', $result['content'])) {
            abort(redirect()->back()->with('errors', $result['content']['error']));
        }

        $charge = GeneralSetting::where('title', 'cable_charge')->first('value');
        $chargedAmount = $deduceCode['amount'] + ($deduceCode['amount'] * $charge['value']);
        $data['chargedAmount'] = $chargedAmount;

        // store the details in a session and return a confirmation box to the user
        session(['serviceID' => $data['serviceID']]);
        session(['pay_method' => $data['pay_service']]);
        session(['phone' => $data['phone']]);
        session(['plan' => $deduceCode['plan']]);
        session(['chargedAmount' => $data['chargedAmount']]);
        session(['amount' => $deduceCode['amount']]);
        session(['variation_code' => $deduceCode['code']]);
        session(['billersCode' => $data['billersCode']]);
        session(['billersName' => $result['content']['Customer_Name']]);
        if (isset($data['subscription_type'])) {
            session(['billersBouquet' => $result['content']['Current_Bouquet']]);
            session(['subscription_type' => $data['subscription_type']]);
        };
        return $result;
    }
}
