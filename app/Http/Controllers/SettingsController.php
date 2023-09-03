<?php

namespace App\Http\Controllers;

use App\Models\DataPrincing;
use App\Models\GeneralSetting;
use App\Models\Settings;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SettingsController extends Controller
{
    
    function settings(Request $request) {
        $validated = $request->validate([
            'monnify_charge' => 'required|numeric',
            'bank_name' => 'required|string',
            'account_no' => 'required|string',
            'account_name' => 'required|string',
          	'telegram_link' => 'nullable|url',
          	'whatsapp_number' => 'nullable|url',
          	'phone_number' => 'nullable|url',
          	'facebook_link' => 'nullable|url',
          	'office_address' => 'nullable|url',
            'enable_paystack' => 'required|in:yes,no',
            'withdrawal_threshold' => 'required|numeric'
        ]);

        $setting = Settings::first();

        $setting->update([
            ...$validated,
            'enable_paystack' => $request->enable_paystack == 'yes' ? true : false
        ]);

        Alert::success('Setting Updated Successfully!');

        return back();
    }

    function generalSettings(Request $request){
        collect($request->except('_token'))->map(function($value, $key) use($request) {
            GeneralSetting::where('title', $key)->update([
                'value' => $value,
                'type' => $request->input('type_'.$key)
            ]);
        });

        Alert::success('Settings Updated Successfully!');
        return back();
    }

    function updateDataplans(Request $request, DataPrincing $dataPrincing) {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'plan_name' => 'required|string'
        ]);

        $dataPrincing->fill($validated);
        $dataPrincing->save();
        
        Alert::success("Data Plan Updated Successfully!");
        return back();
    }

}
