<?php
    $title = 'Buy Recharge Pins';
?>

@extends('layout')
@section('contents')

<div class="container-xl wide-lg">
    <div class="nk-content-body">
        <div class="nk-block-head">
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">Buy Recharge Pins</h2>
                </div>
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <!-- content @s -->
        <div class="nk-content-body" x-data="{
                    cards: {{json_encode($recharge_cards)}},
                    selectedNetwork: '',
                    amount: '',
                    quantity: 1,
                    denominations: {{json_encode($denominations)}}   
                }">
            <div class="kyc-app wide-lg m-auto">
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="nk-kycfm">
                            <div class="nk-kycfm-content">
                                <x-form-swal warning="Procced with recharge pin purchase?" id="recharge-pins-form" action="{{route('rechargepins.purchase')}}" method="POST">
                                    @csrf
                                    <div class="row g-4 d-flex justify-content-center">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Network</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <select name="network" x-on:change="selectedNetwork = $event.target.value" class="form-control form-control-lg"  required>
                                                        <option value="">Select Network</option>
                                                        @foreach($networks as $item)
                                                            <option class="form-control form-control-lg">{{$item}}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-error key='network' />
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Select Recharge Card Value</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <select name="denomination" x-on:change="amount = $event.target.value" class="form-control form-control-lg"  required>
                                                        <option value="">Select Recharge Card Value</option>
                                                        <template x-if="selectedNetwork">
                                                            <template x-for="denomination in denominations">
                                                                <option :value="denomination" x-text="`&#8358;${denomination} ${selectedNetwork}`"></option>
                                                            </template>
                                                        </template>
                                                    </select>
                                                    <x-error key='denomination' />
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Quantity</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <input type="number" :value="quantity" x-on:change="quantity = $event.target.value" name="quantity" class="form-control form-control-lg" min="0" placeholder="Quantity" required>
                                                    <x-error key='quantity' />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Amount</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <input type="text" :value="amount * quantity" name="amount" class="form-control form-control-lg" placeholder="Enter Amount Here" readonly>
                                                    <x-error key='amount' />
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
                                                        <!-- <option value="flw" default>Flutterwave</option> -->
                                                        @if (\App\Models\Settings::first()->enable_paystack)                                                        
                                                            <option value="paystack">Paystack</option>
                                                        @endif
                                                    </select>
                                                    <x-error key='pay_service' />
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
                            <h4>Recharge Card Pins History</h4>
                        </div>
                    </div>
                    @if($recharge_cards->isEmpty())
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
                                        <span class="tb-odr-id">Network</span>
                                    </th>
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">Amount</span>
                                    </th>
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">Quantity</span>
                                    </th>
                                  	<th class="tb-odr-info">
                                        <span class="tb-odr-id">Denomination</span>
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
                                @foreach($recharge_cards as $key => $recharge_card)
                                <tr class="tb-odr-item">
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id">{{$recharge_card->network}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id">{{$recharge_card->quantity * $recharge_card->denomination}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id">{{$recharge_card->quantity}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id">{{$recharge_card->denomination}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="badge badge-pill badge-success">Completed</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id">{{\Carbon\Carbon::parse($recharge_card->created_at)->diffForHumans()}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <div class="tb-odr-btns d-md-inline">
                                            <a href="{{route('rechargepins.single', ['rechargeCard' => $recharge_card->id])}}" class="btn btn-sm btn-primary">View</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- .card-preview -->
                    <div class="row d-flex justify-content-center" style="margin-top: 1rem;">
                        {!! $recharge_cards->links() !!}
                    </div>
                    @endif
                </div><!-- nk-block -->
            </div><!-- kyc-app -->
        </div>
        <!-- content @e -->
    </div>
</div>
@stop