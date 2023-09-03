<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Services\MonnifyService;
use App\Traits\Generics;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BankAccountController extends Controller
{
    use Generics;
    
    function request(Request $request, MonnifyService $monnifyService){
        $user = $request->user();

        $validated = $request->validate([
            'bvn' => 'required|string',
            // 'dateOfBirth' => 'required|string'
        ]);

        // $matchBvn = $monnifyService->verifyBVN($user, $validated);
        // if(!$matchBvn['status']) {
        //     Alert::error($matchBvn['message']);
        //     return back();
        // }


        $monnify = $monnifyService->reserve($user);
        
        if(!$monnify['status']) {
            Alert::error($monnify['message']);
        }

        $bankAccount = BankAccount::create([...$monnify, 'user_id' => $user->id, 'status' => true]);
        
        Alert::success("Bank Account Created Successfully!");
        return back();
    }

}
