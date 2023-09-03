<?php

namespace App\Models;

use App\Enums\Roles;
use App\Traits\PaymentTrait;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, PaymentTrait, Uuids;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'full_name',
    ];

    protected $with = ['wallet', 'referrer', 'plan', 'bankAccount'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $attributes = [
        // 'role' => Roles::USER->value
    ];

    function scopeIsNotAdmin(Builder $query){
        $query->where('role', Roles::USER->value);
    }
    
    function scopeIsAnAdmin(Builder $query){
        $query->where('role', Roles::ADMIN->value)->orWhere('role', Roles::SUPERADMIN->value);
    }

    function scopeIsASuperAdmin(Builder $query){
        $query->where('role', Roles::SUPERADMIN->value);
    }

    public function getIsAdminAttribute() {
        return ($this->role == Roles::ADMIN->value) || ($this->role == Roles::SUPERADMIN->value);
    }

    public function getIsSuperAdminAttribute() {
        return $this->role == Roles::SUPERADMIN->value;
    }

    public function getFullNameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function bankAccount()
    {
        return $this->hasMany(BankAccount::class, 'user_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'user_id');
    }

    public function plan()
    {
        return $this->belongsTo(PackagePlan::class, 'plan_id');
    }

    public function vtuHistories()
    {
        return $this->hasMany(VtuHistory::class, 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    public function referrals() {
        return $this->hasMany(Referral::class, 'referrer');
    }

    public function referrer(){
        return $this->belongsTo(User::class, 'refer_by', 'my_ref_code');
    }    

    public function getReferrerTreeAttribute()
    {
        $getRef = User::where('my_ref_code', $this->refer_by)->first();
        $tree = collect([$getRef]);

        if ($getRef) {
            $tree = $tree->merge($getRef->referrerTree);
        }

        return $tree;
    }
    public function getUplineAttribute()
    {
        return $this->referrerTree; // Return all users in the referral tree except the current user
    }

    public function getPositionOnUpline(User $targetUser)
    {
        $upline = $targetUser->upline;
        $position = $upline->search(function ($user) {
            return $user->id === $this->id;
        });

        return $position !== false ? $position + 1 : null; // Return the position of the user plus 1 to account for zero-indexed array
    }

    public function calculateRefCommission($user, $amount)
    {
        //check the plan package of the upline user and the level of this current user on the upline user's list
        foreach ($this->upline as $item) {
            if ($item) {
                $position = $item->getPositionOnUpline($user);
                $refUserPlanLevel = $item->plan->level_commission;
                if ($position <= $refUserPlanLevel) {
                    $getCommissionValue = LevelCommission::where('identifier', $position)->first();
                    $commission = ($amount * $getCommissionValue['referral_comm']) / 100;

                    $item->wallet->update([
                        'ref_commission' => $item->wallet->ref_commission + $commission,    
                        'points' => $item->wallet->points + $item->plan->point_value
                    ]);

                    $this->updateTransactionHistory($item->id, config('constants.transactions.referral'), $commission, config('constants.pay_method.ref'), config('constants.trans_types.deposit'), config('constants.statuses.completed'));
                }
            }
        }
    }

    public function getDownlineAttribute()
    {
        $downline = collect();
        $this->traverseDownline($this, $downline);
        return $downline;
    }

    private function traverseDownline($user, $downline)
    {
        $referrals = User::where('refer_by', $user->my_ref_code)->get();
        foreach ($referrals as $referral) {
            $downline->push($referral);
            $this->traverseDownline($referral, $downline);
        }
    }

    public function getPositionOnDownline(User $targetUser)
    {
        $downline = $targetUser->downline;
        $position = $downline->search(function ($user) {
            return $user->id === $this->id;
        });

        return $position !== false ? $position + 1 : null;
    }
}
