<?php

namespace App\Services;

use App\Traits\Generics;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class VtPassService {
    use Generics;

    static function authorize(){
        return Http::baseUrl(env('VTPASS_TEST_URL'))->withHeaders([
            'Authorization' => "Basic ".env('VTPASS_TEST_KEY'),
          	'api-key' => env('VTPASS_TEST_KEY'),
          	'secret-key' => env('VTPASS_SECRET_KEY'),
          	'public-key' => env('VTPASS_PUBLIC_KEY')
        ]);
    }

    static function response($response, $route = null){
        $data = $response->json();
        
        if(!$response->ok()) {
            if(!request()->isJson()) Alert::error("Your Request could not be completed! Invalid Response");
            abort(request()->isJson() ? response(['error' => 'Your Request could not be completed! Invalid Response'], 400) : $route ?? back());
        }
        
        // if(isset($data['code']) && $data['code'] != 000) {
            // if(!request()->isJson()) Alert::error($data['errors']);
            // abort(request()->isJson() ? response(['error' => $data['response_description']], 400) : $route ?? back());
        // }
        
        if((key_exists('code', $data) &&  $data['code'] == 000) || (key_exists('response_description', $data) &&  $data['response_description'] == 000)) {
            if($data['content'] && key_exists('error', $data['content'])) {
                if(!request()->isJson()) Alert::error($data['content']['error']);
                abort(request()->isJson() ? response(['error' => $data['content']['error']], 400) : $route ?? back());
            }
        }else{
            if(!request()->isJson()) Alert::error($data['response_description']);
            abort(request()->isJson() ? response(['error' => $data['response_description']], 400) : $route ?? back());
        };

        return $data;
    }

    function requestId(){
        return $this->generateRequestID();

    }




}