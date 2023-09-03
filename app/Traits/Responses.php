<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait Responses
{
    function createNewToken($token)
    {
        return response()->json([
            'status' => true,
            'message' => "Login Was Successful",
            'data' => auth()->user(),
            'access_token' => 'Bearer ' . $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL()
        ]);
    }


    //a method that returns any validator message
    function validatorFails($validator)
    {
        if ($validator->fails()) {
            return response([
                'status' => false,
                'message' => $validator->errors(),
                'data' => "Empty"
            ], 401);
        }
    }


    function failedResponse($message)
    {
        return response([
            'status' => false,
            'message' => $message,
            'data' => null
        ], 400);
    }


    function successResponse($data, $message)
    {
        $result = $data;
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $result
        ], 200);
    }

    
    //a method that reports validation messages for errors and returns data when validation passess
    function validatingRequest($request)
    {
        $data = $request->validated();
        if (!$data) {
            return back()->with('errors', $data->messages()->all()[0])->withInput();
        } else {
            return $data;
        }
    }
}
