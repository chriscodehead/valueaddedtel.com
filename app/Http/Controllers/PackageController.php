<?php

namespace App\Http\Controllers;

use App\Models\PackagePlan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class PackageController extends Controller
{


    /**
     * @param Request $request
     * @param PackagePlan $packagePlan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, PackagePlan $packagePlan){
        $validated = $request->validate([
            'package_name' => 'required|string',
            'reg_fee' => 'required|numeric|min:0',
            'reg_bonus' => 'required|numeric|min:0',
            'level_commission' => 'required|numeric|min:0',
            'point_value' => 'required|numeric|min:0'
        ]);

        $packagePlan->update($validated);
        Alert::success('Package Plan Updated Successfully!');

        return back();
    }

    public function destroy(PackagePlan $packagePlan){

    }

}
