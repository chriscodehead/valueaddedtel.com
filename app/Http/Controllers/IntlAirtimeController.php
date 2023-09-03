<?php

namespace App\Http\Controllers;

use App\Services\IntlAirtimeService;
use App\Traits\Generics;
use App\Traits\PaymentTrait;
use App\Traits\TopUpServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class IntlAirtimeController extends Controller
{
    use Generics, PaymentTrait, TopUpServices;
        
    function countries(Request $request, IntlAirtimeService $intlAirtimeService){
        $user = Auth::user();
        $countries = $intlAirtimeService->countries();

        $vtu_histories = $user->vtuHistories()
        ->where('service', config("constants.services.intlAirtime"))
        ->orderBy('created_at', 'desc')
                                ->paginate(5, ['*'], 'vtu_histories');

        return $this->dynamicPage('intl.countries')->with(compact('countries', 'vtu_histories'));
    }

    function products(Request $request, $code, IntlAirtimeService $intlAirtimeService) {
        $products = $intlAirtimeService->products($code);
        return $this->dynamicPage('intl.products')->with(compact('products', 'code'));;
    }

    function operators(Request $request, $code, $product, IntlAirtimeService $intlAirtimeService) {
        $operators = $intlAirtimeService->operators($code, $product);
        return response($operators);
    }

    function services(Request $request, $code, $product, $operator, IntlAirtimeService $intlAirtimeService) {
        $services = $intlAirtimeService->services($operator, $product);
        return response($services);
    }

    function pay(Request $request, $code, IntlAirtimeService $intlAirtimeService) {
        $user = auth()->user();

        $request->validate([
            'service' => 'required',
            'provider' => 'required',
            'plan' => 'required',
            'amount' => "required|numeric",
            'phone' => "required|numeric",
            'payment_method' => 'required|in:wallet,paystack',
            'pin' => 'required|numeric|min:4'
        ]);
      
      $services = $intlAirtimeService->services($request->provider, $request->service);
        $variation = collect($services['variations'])->where('variation_code', $request->plan)->first();
        if(!$variation) {
            alert()->error('Invalid Service Selected!');
            return back();
        }

        if($variation['fixedPrice'] == 'Yes') {
            $request->replace(['amount' => $variation['variation_amount']]);
        }

        if($variation['fixedPrice'] == 'NO'){
            if(key_exists('variation_amount_min', $variation)){
                if($request->amount < $variation['variation_amount_min']){
                    alert()->error('The amount must be greater than NGN'.$variation['variation_amount_min']);
                    return back();
                }
            }
            
            if(key_exists('variation_amount_max', $variation)){
                if($request->amount > $variation['variation_amount_max']){
                    alert()->error('The amount must be less than NGN'.$variation['variation_amount_max']);
                    return back();
                }
            }
        }
      
      if($request->payment_method == 'wallet'){
        $user = auth()->user();
            if($user->wallet->main_balance < $request->amount) {
                Alert::error("You do not have sufficient funds for this transaction!");
                return back();
            }
        }

        if(!Hash::check($request->pin, $user->pin)) {
            Alert::error("Incorrect Transaction PIN");
            return back();
        }

        $reference = $this->generateRequestID();

        $data = [
            'request_id' => $reference,
            'serviceID' => 'foreign-airtime',
            'billersCode' => $request->phone,
            'variation_code' => $request->plan,
            'amount' => $request->amount,
            'phone' => $request->phone,
            'operator_id' => $request->provider,
            'country_code' => $code,
            'product_type_id' => $request->service,
            'pay_service' => $request->payment_method,
            'email' => $user->email,
        ];

        session(['billingData' => $data]);

        
        return $this->pay_for_service(
            $request->amount,
            "International Airtime",
            $request->payment_method,
            function () use ($data, $intlAirtimeService, $user) {
                $response = $intlAirtimeService->purchase($data);
                                
                $transaction = $this->store_vtu_history($data, config("constants.services.intlAirtime"), 'vtpass', 'success');
                Alert::success('Your transaction was successful!');
                return back();
            },
            route('intl-bills.verify')
        );

    }

    function verify(Request $request, IntlAirtimeService $intlAirtimeService){
        $data = session('billingData');
        $result = $this->verify_transaction_paystack($request);

        if ($result['status'] != true) {
            return to_route('intl-bills.country', ['country_code' => $data['country_code']])->with('errors', 'Payment was not successfull');
        }

        $res = $intlAirtimeService->purchase($data);
        $transaction = $this->store_vtu_history($data, config("constants.services.intlAirtime"), 'vtpass', 'success');
        
        Alert::success('Your transaction was successful!');

        return to_route('intl-bills');
    }

}
