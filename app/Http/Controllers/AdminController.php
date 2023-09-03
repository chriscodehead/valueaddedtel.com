<?php

namespace App\Http\Controllers;

use App\Models\DataPrincing;
use App\Models\GeneralSetting;
use App\Models\PackagePlan;
use App\Models\Settings;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\User;
use App\Models\VtuHistory;
use App\Models\Withdrawal;
use App\Traits\Generics;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller {
    use Generics;

    
	
  	function updateStatus(User $user){
      	$user->status = !$user->status;
      	$user->save();
      	$user->refresh();
      	if($user->status) Alert::success("User's Account has been restored successfully");
      	if(!$user->status) Alert::success("User's Account has been suspended successfully");
      
    	return back();
    }
  
    function verifyEmail(User $user) {
		$user->update([
            'email_verified_at' => now(),
            'isVerified' => true
        ]);
      
      	Alert::success("User Email Address Verified Successfully!");
      	return back();
    }
  
  	function deleteUser(User $user) {
  		$user->wallet()->delete();
      	$user->transactions()->delete();
      	$user->bankAccount()->delete();
      	$user->bankAccount()->delete();
      	$user->vtuHistories()->delete();
      	$user->referrals()->delete();
      	$user->delete();
      
      	Alert::success("User's Account has been suspended successfully");
      	return back();
    }
  
    function dataplans(){
        return view('admin.dataplans', [
            'plans' => DataPrincing::all(),
            'user' => auth()->user()
        ]);
    }

    function withdrawPV(Request $request, User $user){
        $request->validate([
            'amount' => 'required|numeric'
        ]);
        
        if($user->wallet->points < $request->amount) {
            Alert::error('This User has Insufficient Funds');
            return back();
        }

        $oldBalance = $user->wallet->points;
        
        $user->wallet->points -= $request->amount;
        $user->wallet->save();
        $user->wallet->refresh();

        Transaction::create([
            'user_id' => $user->id,
            'purpose' => "PV Withdrawal",
            'amount' => $request->amount,
            'payment_method' => 'wallet',
            'trans_type' => config('constants.trans_types.withdraw'),
            'status' => config('constants.statuses.completed'),
            'prev_bal' => $oldBalance,
            'new_bal' =>  $user->wallet->main_balance
        ]);
        
        Alert::success('PV Withdrawal Successful');
        return back();
    }

    public function deposit(Request $request, User $user){
        $request->validate([
            'amount' => 'required|numeric'
        ]);

        $oldBalance = $user->wallet->main_balance;

        $user->wallet->main_balance += $request->amount;
        $user->wallet->save();
        $user->wallet->refresh();

        Transaction::create([
            'user_id' => $user->id,
            'purpose' => "Deposit",
            'amount' => $request->amount,
            'payment_method' => 'wallet',
            'trans_type' => config('constants.trans_types.deposit'),
            'status' => config('constants.statuses.completed'),
            'prev_bal' => $oldBalance,
            'new_bal' =>  $user->wallet->main_balance
        ]);

        Alert::success('Funds Deposit Successful');
        return back()->with('success', 'Funds Deposit Successful');
    }
    
    public function withdraw(Request $request, User $user){
        $request->validate([
            'amount' => 'required|numeric'
        ]);
        
        if($user->wallet->main_balance < $request->amount) {
            Alert::error('This User has Insufficient Funds');
            return back();
        }

        $oldBalance = $user->wallet->main_balance;
        
        $user->wallet->main_balance -= $request->amount;
        $user->wallet->save();
        $user->wallet->refresh();

        Transaction::create([
            'user_id' => $user->id,
            'purpose' => "Withdrawal",
            'amount' => $request->amount,
            'payment_method' => 'wallet',
            'trans_type' => config('constants.trans_types.withdraw'),
            'status' => config('constants.statuses.completed'),
            'prev_bal' => $oldBalance,
            'new_bal' =>  $user->wallet->main_balance
        ]);
        
        Alert::success('Funds Withdrawal Successful');
        return back()->with('success', '');
    }

    public function index() {
        $user = auth()->user();
		$withdrawals = Transaction::withdrawals()->completed()->sum('amount');
        $deposits = Transaction::deposits()->completed()->sum('amount');
        $pv = Transaction::pointValue()->completed()->sum('amount');
        $cashback = Transaction::cashback()->completed()->sum('amount');
        return view('admin.dashboard', compact(['withdrawals', 'user', 'deposits', 'pv', 'cashback']));
    }

    public function users(Request $request){
        $user = auth()->user();
        $users = User::isNotAdmin()
          				->join('wallets', 'users.id', 'wallets.user_id')
          				->select('users.*', 'wallets.monthly_pv')
      					->when($request->keyword, function($query, $keyword){
                        	$query->where('firstname', 'LIKE', "%$keyword%")
                              		->orWhere('lastname', 'LIKE', "%$keyword%")
                              		->orWhere('username', 'LIKE', "%$keyword%");
                        })
          				->when($request->sort, function($query, $sort){
                        	$query->where('monthly_pv', ">", 0)->orderByDesc('monthly_pv');
                        })
          				->when(!$request->sort, function($query, $sort){
                        	$query->latest();
                        })
          				->paginate();

        return view('admin.users')->with([
            'users' => $users,
            'user' => $user
        ]);
    }

    public function topUsers(Request $request){
        $user = auth()->user();

        $users = User::isNotAdmin()
          				->when($request->keyword, function($query, $keyword){
                        	$query->where('firstname', 'LIKE', "%$keyword%")
                              		->orWhere('lastname', 'LIKE', "%$keyword%")
                              		->orWhere('username', 'LIKE', "%$keyword%");
                        })
          				->when($request->sort, function($query, $sort){
                        	$query->where('monthly_pv', ">", 0)->orderByDesc('monthly_pv');
                        })
          				->join('wallets', 'users.id', 'wallets.user_id')
          				->select('users.*', 'wallets.monthly_pv')
          				->paginate();

        return view('admin.users')->with([
            'users' => $users,
            'user' => $user
        ]);
    }

    public function transfers() {
        $user = auth()->user();
        $transfers = Transfer::with(['sender', 'receiver'])->latest()->paginate();

        return view('admin.transfers', [
            'user' => $user,
            'transfers' => $transfers
        ]);
    }

    public function transactions() {
        $user = auth()->user();
        $transactions = Transaction::with(['user'])->latest()->paginate();

        return view('admin.transactions', [
            'user' => $user,
            'transactions' => $transactions
        ]);
    }
    
    
    public function deposits() {
        $user = auth()->user();

        $transactions = Transaction::where([
            'trans_type' => config('constants.trans_types.deposit')
        ])->with(['user'])->latest()->paginate();

        return view('admin.deposits', [
            'user' => $user,
            'transactions' => $transactions
        ]);
    }
    
    public function withdrawals(Request $request) {
        $user = auth()->user();

        $transactions = Withdrawal::when($request->status, function($query, $status){
            $query->where('status', $status);
        })->latest()->paginate();

        return view('admin.withdrawals', [
            'user' => $user,
            'transactions' => $transactions
        ]);
    }

    function histories(){
        $user = auth()->user();
       $vtu_histories = VtuHistory::with(['user'])->latest()->paginate();
        //$vtu_histories = VtuHistory::with(['user'])->latest();
        
        return view('admin.vtu-history', compact('vtu_histories', 'user'));
    }
    
    function settings(){
        $settings = Settings::first();
        $generalSettings = GeneralSetting::all();
        $user = auth()->user();
        
        return view('admin.settings', compact('settings', 'generalSettings', 'user'));
    }

    function packages(){
        $user = auth()->user();
        $packages = PackagePlan::paginate();

        return view('admin.packages', compact('packages', 'user'));
    }

    function createAdmin(Request $request) {
        $defaultPlan = PackagePlan::first();

        $validated = $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'password' => 'required|string',
            'phone' => 'required|numeric'
        ]);

        User::create([
             ...$validated,
             'isVerified' => "1",
            'email_verified_at' => now(),
            'my_ref_code' => $this->createUniqueRand('users', 'my_ref_code'),
            'plan_id' => $defaultPlan->id,
            'no_of_referrals' => "0",
        ]);

        alert()->success('Admin Account Created Successfully!');
        return back();
    }

    
}
