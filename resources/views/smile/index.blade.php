<?php
$title = 'Smile Subscription';
?>
@extends('layout')
@section('contents')

<div class="container-xl wide-lg">
    <div class="nk-content-body">
        <div class="nk-block-head">
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">Smile Subscription</h2>
                </div>
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <!-- content @s -->
        <div class="nk-content-body" x-data="{
                emailStatus: false,
                emailLoading: false,
                email: '',
                name: '',
                accounts: [],
                plans: {{json_encode($plans)}},
                amount: '',
                selectedPlan: null
            }">
            <div class="kyc-app wide-lg m-auto">
                <div class="nk-block">
                    @include('components.upgrade-account')
                    <div class="card card-bordered">
                        <div class="nk-kycfm">
                            <div class="nk-kycfm-content">
                                <x-form-swal warning="Proceed with smile subscription?" id="smile-subscription-form" action="{{route('smile.purchase')}}" autocomplete="off"  method="POST">
                                    @csrf
                                    <div class="row g-4 d-flex justify-content-center">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Smile Email Address</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <input type="email" :value="email" x-on:change="
                                                        emailLoading = true;
                                                        fetch(`/smile/verify-account/${$event.target.value}`, {
                                                            method: 'GET',
                                                            headers: {
                                                                Accept: 'application/json',
                                                                'Content-Type': 'application/json'
                                                            }
                                                        })
                                                        .then(async (res) => {
                                                            const data = await res.json()
                                                            if(!res.ok) return Swal.fire(data.error, '', 'error')
                                                            name = data.Customer_Name
                                                            accounts = data.AccountList.Account
                                                            emailLoading = true;
                                                        })
                                                    " name="smile_mail" autocomplete="off"  class="form-control form-control-lg" placeholder="Smile Email Address">
                                                </div>
                                            </div>
                                        </div>   
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Customer Name</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <input  :value="name" readonly name="name" class="form-control form-control-lg" placeholder="Smile ">
                                                </div>
                                            </div>    
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Select Smile Account</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <select name="account" class="form-control form-control-lg"  required>
                                                        <option value="">Select Smile Account</option>
                                                        <template x-for="account in accounts" >
                                                            <option :value="account.AccountId"   x-text="account.FriendlyName" ></option>
                                                        </template>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Select Plan</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <select name="plan" x-on:change="
                                                        selectedPlan = plans.find(x => x.variation_code == $event.target.value.split('/')[0]);
                                                        amount = selectedPlan?.variation_amount || ''
                                                    " class="form-control form-control-lg" id="plan" required>
                                                        <option value="">Select Plan</option>
                                                        @foreach($plans as $item)
                                                        <option value="{{$item['variation_code']}}/{{$item['name']}}" class="form-control form-control-lg">{{$item['name']}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Amount</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <input type="text" id="amount" :value="amount" x-on:change="amount = $event.target.value" name="amount" class="form-control form-control-lg" placeholder="Enter Amount Here" :readonly="selectedPlan?.variation_amount > 0">
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Phone Number</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <input type="tel" name="phone" class="form-control form-control-lg" placeholder="Enter phone number" required>
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Select Payment Method</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control form-control-lg" name="pay_service" required>
                                                        <option value="">Select Here</option>
                                                        <option value="wallet" default>Wallet - NGN{{number_format($user['wallet']['main_balance'], 2)}}</option>
                                                        @if (\App\Models\Settings::first()->enable_paystack)                                                        
                                                            <option value="paystack">Paystack</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Enter Transaction PIN</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <input type="password" minlength="4" maxlength="4" pattern="[0-9]{4}" id="pin" class="form-control form-control-lg" placeholder="Enter PIN here" name="pin" required>
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-lg-12">
                                            <div class="row d-flex justify-content-center">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-lg btn-primary" id="submit-btn">Click to Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .row -->
                                </x-form-swal>
                            </div><!-- .nk-kycfm-content -->
                        </div><!-- .nk-kycfm -->
                    </div><!-- .card -->
                </div><!-- nk-block -->
                <div class="nk-block nk-block-lg" style="margin-top: 3rem;">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4>Data Purchase History</h4>
                        </div>
                    </div>
                    @if($vtu_histories->isEmpty())
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <p style="text-align: center;">
                                There are currently no data transactions yet from the account!!!
                            </p>
                        </div>
                    </div>
                    @else
                    <div class="card card-bordered card-preview table-responsive">
                        <table class="table table-orders">
                            <thead class="tb-odr-head">
                                <tr class="tb-odr-item">
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">S/N</span>
                                    </th>
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">Amount</span>
                                    </th>
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">Payment Method</span>
                                    </th>
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">Network</span>
                                    </th>
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">Plan</span>
                                    </th>
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">Status</span>
                                    </th>
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">Date</span>
                                    </th>
                                    <th class="tb-odr-info">Action</th>
                                </tr>
                            </thead>
                            <tbody class="tb-odr-body">
                                @foreach($vtu_histories as $key=>$item)
                                <tr class="tb-odr-item">
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id">{{ $vtu_histories->firstItem() + $key }}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id">₦{{number_format($item->amount, 2)}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id" style="text-transform: capitalize;">{{$item->payment_method}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id" style="text-transform: uppercase;">{{$item->network}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id">{{Str::limit($item->vtu_plan, 15, '...')}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        @if($item->status == "pending")
                                        <span class="badge badge-pill badge-warning">{{$item->status}}</span>
                                        @elseif($item->status == "success")
                                        <span class="badge badge-pill badge-success">{{$item->status}}</span>
                                        @else
                                        <span class="badge badge-pill badge-primary">{{$item->status}}</span>
                                        @endif
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id">{{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <div class="tb-odr-btns d-md-inline">
                                            <a href="/single-history/{{$item->id}}" class="btn btn-sm btn-primary">View</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- .card-preview -->
                    <div class="row d-flex justify-content-center" style="margin-top: 1rem;">
                        {!! $vtu_histories->appends(['vtu_histories'=>$vtu_histories->currentPage()])->links() !!}
                    </div>
                    @endif
                </div><!-- nk-block -->
            </div><!-- kyc-app -->
        </div>
        <!-- content @e -->
    </div>
</div>
@stop