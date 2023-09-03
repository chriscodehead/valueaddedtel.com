<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ElectricityController;
use App\Http\Controllers\frontend\AirtimeController;
use App\Http\Controllers\frontend\AuthController;
use App\Http\Controllers\frontend\BuyAirtimeController;
use App\Http\Controllers\frontend\BuyCableController;
use App\Http\Controllers\frontend\PaymentController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\frontend\BuyDataController;
use App\Http\Controllers\frontend\GeneralController;
use App\Http\Controllers\IntlAirtimeController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\RechargeCardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShowmaxController;
use App\Http\Controllers\SmileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/webhook', [WebhookController::class, 'resolve'])->name('webhook.resolve');

Route::get('/', function () {
    return view('homepage.index');
});

Route::get('about', [GeneralController::class, 'about'])->name('about');
Route::get('how-it-works', [GeneralController::class, 'howItWorks'])->name('how-it-works');
Route::get('packages', [GeneralController::class, 'packages'])->name('packages');
Route::get('incentives', [GeneralController::class, 'incentives'])->name('incentives');
Route::get('contact', [GeneralController::class, 'contact'])->name('contact');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('do-login', [AuthController::class, 'doLogin'])->name('do-login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('do-register', [AuthController::class, 'doRegister'])->name('do-register');

Route::middleware('auth')->group(function(){
    Route::get('verify-email', [AuthController::class, 'verifyEmail'])->name('verify-email');
    Route::post('do-verify', [AuthController::class, 'doVerify'])->name('do-verify');
  Route::get('verify-email/resend', [AuthController::class, 'resendVerificationEmail'])->name('verify-email.resend');
  
});

Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('request-reset-password', [AuthController::class, 'requestResetPassword'])->name('request-reset-password');
Route::get('reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
Route::post('do-reset-password', [AuthController::class, 'doResetPassword'])->name('do-reset-password');
Route::get('print-reciept/{type}/{id}', [PaymentController::class, 'reciept'])->name('reciept.print');

Route::group(['middleware' => ['auth:web']], function () {
    
    Route::middleware('email')->group(function(){
        Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('wallet', [UserController::class, 'wallet'])->name('wallet');
    Route::get('upgrade', [UserController::class, 'upgrade'])->name('upgrade');

    Route::prefix('referral')->group(function(){
        Route::get('/', [UserController::class, 'referral'])->name('referral');
        Route::get('/{user:username}', [UserController::class, 'downlines'])->name('referral.downlines');
    });

    Route::post('/bvn/request', [BankAccountController::class, 'request'])->name('bvn.request');

    Route::prefix('admin')->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

        Route::prefix('withdrawals')->group(function(){
            Route::prefix('{withdrawal}')->group(function(){
                Route::get('approve', [WithdrawalController::class, 'approve'])->name('admin.withdrawal.approve');
                Route::get('delete', [WithdrawalController::class, 'destroy'])->name('admin.withdrawal.delete');
                Route::post('decline', [WithdrawalController::class, 'decline'])->name('admin.withdrawal.decline');
              
            });
        })->middleware('role:superadmin');
        
        Route::prefix('{user}')->group(function(){
            Route::post('/withdraw', [AdminController::class, 'withdraw'])->name('admin.user.withdraw');
            Route::post('/deposit', [AdminController::class, 'deposit'])->name('admin.user.deposit');
            Route::post('/pv-withdraw', [AdminController::class, 'withdrawPV'])->name('admin.user.withdraw-pv');
            Route::get('/status', [AdminController::class, 'updateStatus'])->name('admin.user.status');
            Route::get('/delete', [AdminController::class, 'deleteUser'])->name('admin.user.delete');
          	Route::get('/verify', [AdminController::class, 'verifyEmail'])->name('admin.user.verify-email');
        });    

        Route::prefix('users')->group(function(){
            Route::get('/', [AdminController::class, 'users'])->name('admin.users');
            Route::get('/top', [AdminController::class, 'topUsers'])->name('admin.users.top');
            Route::prefix('{user:username}')->group(function(){
                Route::get('/', [UserController::class, 'show'])->name('admin.users.details');
                Route::get('/transactions', [UserController::class, 'transactions'])->name('admin.users.transactions');
                Route::get('/vtu-history', [UserController::class, 'vtuHistory'])->name('admin.users.vtuHistory');
                Route::get('/referrals', [UserController::class, 'referrals'])->name('admin.users.referrals');
                Route::get('/referrals/{downline}', [UserController::class, 'adminUserDownlines'])->name('admin.users.downlines');
                Route::get('/profile', [UserController::class, 'editProfile'])->name('admin.users.profile');
                Route::post('admin/update-profile', [UserController::class, 'adminUpdateProfile'])->name('admin.users.update-profile');
                Route::post('admin/update-bank', [UserController::class, 'adminUpdateBank'])->name('admin.users.update-bank');
                Route::post('admin/update-pin', [UserController::class, 'adminUpdateUserPin'])->name('admin-update-pin');
            });
        });

        Route::prefix('dataplans')->group(function(){
            Route::get('/', [AdminController::class, 'dataplans'])->name('admin.dataplans');
            Route::prefix('{dataPrincing}')->group(function(){
                Route::post('/update', [SettingsController::class, 'updateDataplans'])->name('admin.dataplans.update');

            });
        });

        Route::get('/transfers', [AdminController::class, 'transfers'])->name('admin.transfers');
        Route::get('/histories', [AdminController::class, 'histories'])->name('admin.histories');
        Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
        Route::post('/settings', [SettingsController::class, 'settings'])->name('admin.settings.update');

        Route::prefix('transactions')->group(function(){
            Route::get('/', [AdminController::class, 'transactions'])->name('admin.transactions');
            Route::get('/deposits', [AdminController::class, 'deposits'])->name('admin.deposits');
            Route::get('/withdrawals', [AdminController::class, 'withdrawals'])->name('admin.withdrawals');
        });
        Route::post('/general-settings', [SettingsController::class, 'generalSettings'])->name('admin.generalSettings.update');

        Route::prefix('/packages')->group(function(){
            Route::get('/', [AdminController::class, 'packages'])->name('admin.packages');
            Route::prefix('/{packagePlan}')->group(function () {
                Route::post('/update', [PackageController::class, 'update'])->name('admin.packages.update');
            });
        });
    });

    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('update-profile', [UserController::class, 'update_profile'])->name('update-profile');
    Route::post('update-bank', [UserController::class, 'update_bank'])->name('update-bank');
    Route::post('update-pin', [UserController::class, 'update_pin'])->name('update-pin');
    Route::post('set-pin', [UserController::class, 'set_pin'])->name('set-pin');
    Route::post('update-password', [UserController::class, 'update_password'])->name('update-password');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('transaction/{trans}', [UserController::class, 'transaction'])->name('transaction');
    Route::get('delete-transaction/{trans}', [UserController::class, 'deleteTransaction'])->name('delete-transaction');

    //payment management routes
    Route::post('initiate-top-up', [PaymentController::class, 'initiateTopUp'])->name('initiate-top-up');
    Route::get('verify-top-up', [PaymentController::class, 'verifyTopUp'])->name('verify-top-up');
    Route::get('purchase-plan-flw/{plan}', [PaymentController::class, 'purchasePlanFlw'])->name('purchase-plan-flw');
    Route::get('verify-plan-purchase-flw', [PaymentController::class, 'confirmPurchaseFlw'])->name('verify-plan-purchase-flw');
    Route::get('purchase-plan-paystack/{plan}', [PaymentController::class, 'purchasePlanPaystack'])->name('purchase-plan-paystack');
    Route::get('verify-plan-purchase-paystack', [PaymentController::class, 'confirmPurchasePaystack'])->name('verify-plan-purchase-paystack');
    Route::post('purchase-plan-wallet', [PaymentController::class, 'purchasePlanWallet'])->name('purchase-plan-wallet');

    Route::prefix('transfer')->group(function(){
        Route::post('/send', [TransferController::class, 'store'])->name('transfer.initiate');
        Route::get('/move', [TransferController::class, 'transferToMainWallet'])->name('transfer.move');
    });

    Route::prefix('withdrawal')->group(function(){
        Route::post('/', [WithdrawalController::class, 'store'])->name('withdrawl.initiate');
    });

    Route::get('history', [UserController::class, 'history'])->name('history');
    Route::get('single-history/{history}', [UserController::class, 'singleHistory'])->name('single-history');
    Route::get('delete-history/{history}', [UserController::class, 'deleteHistory'])->name('delete-history');

    //data management routes
    Route::get('buy-data', [BuyDataController::class, 'buyData'])->name('buy-data');
    Route::get('get-plan-type/{network}', [BuyDataController::class, 'getPlanType'])->name('get-plan-type');
    Route::get('get-plan/{planType}', [BuyDataController::class, 'getPlan'])->name('get-plan');
    Route::post('buy-now', [BuyDataController::class, 'buyNow'])->name('buy-now')->middleware('check.free.user');
    Route::get('all-plans', [BuyDataController::class, 'allPlans'])->name('all-plans');
    Route::get('verify-data-sub', [BuyDataController::class, 'verifyDataSub'])->name('verify-data-sub');

    //airtime management routes
    Route::get('airtime', [BuyAirtimeController::class, 'airtime'])->name('airtime');
    Route::post('buy-airtime', [BuyAirtimeController::class, 'buyNow'])->name('buy-airtime')->middleware('check.free.user');
    Route::get('verify-airtime-sub', [BuyAirtimeController::class, 'verifyAirtimeSub'])->name('verify-airtime-sub');

    //buy cable maganement routes
    Route::get('cable', [BuyCableController::class, 'cable'])->name('cable');
    Route::post('buy-cable', [BuyCableController::class, 'buyCable'])->name('buy-cable');
    Route::get('cable-confirm', [BuyCableController::class, 'cableConfirm'])->name('cable-confirm');
    Route::post('submit-cable', [BuyCableController::class, 'submitCable'])->name('submit-cable');
    Route::get('verify-cable-sub', [BuyCableController::class, 'verifyCableSub'])->name('verify-cable-sub');

    // Electricity
    Route::prefix('electricity')->group(function(){
        Route::get('/', [ElectricityController::class, 'index'])->name('electricity');
        Route::post('/', [ElectricityController::class, 'store'])->name('electricity.buy')->middleware('check.free.user');
        Route::get('/verify', [ElectricityController::class, 'verify'])->name('electricity.verify');
    });

    Route::prefix('education')->group(function(){
        Route::get('/', [EducationController::class, 'index'])->name('education');
        Route::get('/verify', [EducationController::class, 'verify'])->name('education.verify');
        Route::get('/{service_id}', [EducationController::class, 'single'])->name('education.service');
        Route::post('/{service_id}', [EducationController::class, 'store'])->name('education.store')->middleware('check.free.user');
    });

    Route::prefix('intl-bills')->group(function(){
        Route::get('/', [IntlAirtimeController::class, 'countries'])->name('intl-bills');
        Route::get('/verify', [IntlAirtimeController::class, 'verify'])->name('intl-bills.verify');
        Route::post('/pay/{country_code}', [IntlAirtimeController::class, 'pay'])->name('intl-bills.pay')->middleware('check.free.user');
        Route::get('/{country_code}', [IntlAirtimeController::class, 'products'])->name('intl-bills.country');
        Route::get('/{country_code}/{product}', [IntlAirtimeController::class, 'operators'])->name('intl-bills.operators');
        Route::get('/services/{country_code}/{product}/{operator}', [IntlAirtimeController::class, 'services'])->name('intl-bills.services');
    });
    
    Route::prefix('smile')->group(function(){
        Route::get('/', [SmileController::class, 'index'])->name('smile');
        Route::get('/verify', [SmileController::class, 'verify'])->name('smile.verify');
        Route::get('/verify-account/{email}', [SmileController::class, 'verifyAccount'])->name('smile.verify-account');
        Route::post('/purchase', [SmileController::class, 'purchase'])->name('smile.purchase')->middleware('check.free.user');
    });
    
    Route::prefix('showmax')->group(function(){
        Route::get('/', [ShowmaxController::class, 'index'])->name('showmax');
        Route::get('/verify', [ShowmaxController::class, 'verify'])->name('showmax.verify');
        Route::post('/purchase', [ShowmaxController::class, 'purchase'])->name('showmax.purchase')->middleware('check.free.user');
    });

    Route::prefix('recharge-pins')->group(function(){
        Route::get('/', [RechargeCardController::class, 'index'])->name('rechargepins');
        Route::get('/callback', [RechargeCardController::class, 'callback'])->name('rechargepins.callback');
        Route::get('/verify', [RechargeCardController::class, 'verify'])->name('rechargepins.verify');
        Route::post('/purchase', [RechargeCardController::class, 'purchase'])->name('rechargepins.purchase')->middleware('check.free.user');
        Route::prefix('{rechargeCard}')->group(function(){
            Route::get('/', [RechargeCardController::class, 'show'])->name('rechargepins.single');
        });
    });
    });

    
});
