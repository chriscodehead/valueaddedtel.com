<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SetPinRequest;
use App\Http\Requests\UpdateBankRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdatePinRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\PackagePlan;
use App\Models\Transaction;
use App\Models\User;
use App\Models\VtuHistory;
use App\Services\MonnifyService;
use App\Services\ReferralService;
use App\Traits\Generics;
use App\Traits\PaymentTrait;
use App\Traits\Responses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use Generics, PaymentTrait, Responses;

    function referrals(User $user){
        $auth_user = auth()->user();
        $selectedUser = User::with(['vtuHistories', 'transactions', 'referrals'])->find($user->id);
        $referrals = $selectedUser->referrals()->paginate();

        return view('admin.user.referrals', [
            'user' => $auth_user,
            'selectedUser' => $selectedUser,
            'referrals' => $referrals
        ]);
    }

    function adminUserDownlines(User $user, $downline){
        $auth_user = auth()->user();
        $selectedUser = User::with(['vtuHistories', 'transactions', 'referrals'])->find($user->id);
        if(!$downline = User::where('username', $downline)->first()) abort(404);
        $downlines = $downline->getDownlineAttribute();

        // dd($downlines);

        return view('admin.user.downlines', [
            'user' => $auth_user,
            'selectedUser' => $selectedUser,
            'referrals' => $downlines,
            'referrer' => $downline
        ]);
    }

    public function dashboard()
    {
        return $this->dynamicPage('user.dashboard');
    }

    public function wallet()
    {
        return $this->dynamicPage('user.wallet');
    }

    function show(User $user){
        $auth_user = auth()->user();
        $selectedUser = User::with(['vtuHistories', 'transactions', 'referrals'])->find($user->id);
      
        return view('admin.user.details', [
            'user' => $auth_user,
            'selectedUser' => $selectedUser
        ]);
    }

    function transactions(User $user){
        $selectedUser = User::with(['vtuHistories', 'transactions', 'referrals'])->find($user->id);
        $user = auth()->user();
      	$transactions = $selectedUser->transactions()->paginate();
        return view('admin.user.transactions', compact('user', 'selectedUser', 'transactions'));
    }

    function vtuHistory(User $user){
        $selectedUser = User::with(['vtuHistories', 'transactions', 'referrals'])->find($user->id);
        $user = auth()->user();
        $vtu_histories = VtuHistory::with(['user'])->paginate();
        return view('admin.user.vtu', compact('user', 'selectedUser', 'vtu_histories'));
    }

    function editProfile(User $user){
        $selectedUser = User::with(['vtuHistories', 'transactions', 'referrals'])->find($user->id);
        $user = auth()->user();
        $allBanks = Bank::all();
        return view('admin.user.profile', compact('user', 'selectedUser', 'allBanks'));
    }

    public function profile()
    {
        return $this->dynamicPage('user.profile');
    }

    public function update_profile(UpdateProfileRequest $request)
    {
        $user = User::where('id', auth('web')->user()->id)->first();
        $data = $this->validatingRequest($request);
        $user->update($data);
        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }
    
    function adminUpdateProfile(UpdateProfileRequest $request, User $user) {
        $data = $request->validate([
            'firstname' => ['nullable', 'string'],
            'lastname' => ['nullable', 'string'],
            'username' => ['nullable', 'string', 'unique:users,username,' . $user->id],
            'email' => ['nullable', 'email', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'unique:users,phone,' . $user->id,]
        ]);

        $user->update($data);
        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }

    function adminSuspendUser(){
        
    }

    public function adminUpdateBank(UpdateBankRequest $request, User $user)
    {
        $user = User::where('id', auth('web')->user()->id)->first();
        $data = $this->validatingRequest($request);
        $bank = Bank::where('bank_code', $request->bank_code)->first();
        $user->update([...$data, 'bank_name' => $bank->bank_name]);
        return redirect()->back()->with('success', 'Bank info Updated Successfully');
    }
  
  	function adminUpdateUserPin(Request $request, User $user){
      	$request->validate([
        	'pin' => 'required|confirmed'
        ]);
        $request->pin = Hash::make($request->pin);
        $user->update($request->only('pin'));
        return redirect()->back()->with('success', 'User PIN Updated Successfully');
    }

    public function update_bank(UpdateBankRequest $request)
    {
        $user = User::where('id', auth('web')->user()->id)->first();
        $data = $this->validatingRequest($request);
        $bank = Bank::where('bank_code', $request->bank_code)->first();
        // return $data;
        $user->update([...$data, 'bank_name' => $bank->bank_name]);
        return redirect()->back()->with('success', 'Bank info Updated Successfully');
    }

    public function update_password(UpdatePasswordRequest $request)
    {
        $user = User::where('id', auth('web')->user()->id)->first();
        $data = $this->validatingRequest($request);
        $data['password'] = Hash::make($data['password']);
        $user->update($data);
        return redirect()->back()->with('success', 'Password Updated Successfully');
    }

    public function update_pin(UpdatePinRequest $request) {
        $user = User::where('id', auth('web')->user()->id)->first();
        $data = $this->validatingRequest($request);
        $data['pin'] = Hash::make($data['pin']);
        $user->update($data);
        return redirect()->back()->with('success', 'PIN Updated Successfully');
    }

    public function set_pin(SetPinRequest $request, MonnifyService $monnifyService) {
        $user = User::where('id', auth('web')->user()->id)->first();
        $data = $this->validatingRequest($request);
        $data['pin'] = Hash::make($data['pin']);

        if($user->bankAccount()->count() < 1){
            try{
                $bankAccount = $monnifyService->reserve($user); 
                if(!$bankAccount['status']) {
                    throw new \Exception($bankAccount['message']);
                }
                
                foreach ($bankAccount['data'] as $value) {
                    BankAccount::create([...$value, 'user_id' => $user->id, 'status' => true]);
                }                
            } catch(\Exception $e){
                Alert::error($e->getMessage());
                return back();
            }
        }

        $user->update($data);
        return redirect()->back()->with('success', 'Your PIN has been set');
    }

    function downlines(User $user){
        $downlines = $user->getDownlineAttribute();

        return $this->dynamicPage('user.downlines')->with([
            'referrals' => $downlines,
            'referrer' => $user
        ]);

    }

    public function transaction(Transaction $trans) {
        $transaction = ['transaction' => $trans];
        return $this->dynamicPage('user.transaction')->with($transaction);
    }

    public function deleteTransaction(Transaction $trans)
    {
        $trans->delete();
        return redirect()->route('dashboard')->with('success', "Transaction record was removed successfully");
    }

    public function upgrade()
    {
        return $this->dynamicPage('user.upgrade');
    }

    public function referral() {
        $user = auth()->user();
        // dd($user->referrals);
        return $this->dynamicPage('user.referral')->with(['referralTable' => $user->referrals]);
    }

    public function history()
    {
        return $this->dynamicPage('vtu.history');
    }

    public function singleHistory(VtuHistory $history)
    {
        $vtu_history = ['transaction' => $history];
        return $this->dynamicPage('vtu.single-history')->with($vtu_history);
    }

    public function deleteHistory(VtuHistory $history)
    {
        $history->delete();
        return redirect()->route('history')->with('success', "Record was removed successfully");
    }

    //logout method
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success', "Logout was Successfull");
    }
}
