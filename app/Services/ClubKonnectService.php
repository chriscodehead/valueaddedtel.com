<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class ClubKonnectService {

    public $networks = [
        'MTN' => '01',
        'GLO' => '02',
        'ETISALAT' => '03',
        'AIRTEL' => '04'
    ];

    function api(){
        return Http::baseUrl(env('CLUB_KONNECT_URL'));
    }

    public $denominations = ['100', '200', '500'];

    function ip(){
        request()->ip();
    }

    function rechargePinServices(){
        $req = $this->api()->get('APIEPINDiscountV1.asp');
        return $req->json()['MOBILE_NETWORK'];
    }

    function airtime($network, $amount, $phoneNo, $requestId){
        $services = $this->rechargePinServices();
        $req = $this->api()->get('/APIAirtimeV1.asp', [
            'UserID' => env('CLUB_KONNECT_USER'),
            'APIKey' => env('CLUB_KONNECT_KEY'),
            'MobileNetwork' => $services[$network][0]['ID'],
            'Amount' => $amount,
            'MobileNumber' => $phoneNo,
            'RequestID' => $requestId,
            'CallBackURL' => route('rechargepins.callback')
        ]);
      
      

        if(!$req->ok()) {
            Alert::error('Your request could not be completed!');
            return abort(back()->with('error', 'Your request could not be completed!'));
        }

        $data = $req->json();


        return true;
    }
  
  	function getRechargePins($reference){
    	$req = $this->api()->get('/APIQueryV1.asp', [
            'UserID' => env('CLUB_KONNECT_USER'),
            'APIKey' => env('CLUB_KONNECT_KEY'),
            'RequestID' => $reference,
        ]);
      	
        $data = $req->json();

        if(!$req->ok()) {
              Alert::error('Your request could not be completed!');
              return abort(back()->with('error', 'Your request could not be completed!'));
          }

        if(array_key_exists('TXN_EPIN', $data)){
          return $data['TXN_EPIN'];
        }
      
      	return [];
    }

    function rechargeCards($network, $denomination, $quantity, $requestId){
        $services = $this->rechargePinServices();
        
        $req = $this->api()->get('/APIEPINV1.asp', [
            'UserID' => env('CLUB_KONNECT_USER'),
            'APIKey' => env('CLUB_KONNECT_KEY'),
            'MobileNetwork' => $services[$network][0]['ID'],
            'Value' => $denomination,
            'Quantity' => $quantity,
            'RequestID' => $requestId,
            'CallBackURL' => route('rechargepins.callback')
        ]);

        $data = $req->json();

        if(!$req->ok()) {
            Alert::error('Your request could not be completed!');
            return abort(back()->with('error', 'Your request could not be completed!'));
        }
        
        if(!array_key_exists('TXN_EPIN', $data)){
            Alert::error('Your request could not be completed!');
            return abort(back()->with('error', 'Your transaction could not be completed!'));
        }
        
        return $data['TXN_EPIN'];
    }

}