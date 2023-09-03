<?php

use App\Models\PackagePlan;

$title = 'Transaction Details';
$plan = PackagePlan::where('reg_fee', $transaction['amount'])->first();

$transaction['purpose'] == config('constants.transactions.plan_upgrade')
    ? $value = $transaction['purpose'] . " to " . $plan->package_name
    : $value = $transaction['purpose']
?>

@extends('layout')
@section('contents')
<div class="container-xl wide-lg">
    <div class="nk-content-body">
        <div class="nk-block-head">
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">Transaction Details</h2>
                </div>
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <!-- content @s -->
        <div class="nk-content nk-content-fluid">
            <div class="container-xl wide-lg">
                <div class="nk-content-body">
                    <div class="kyc-app wide m-auto">
                        <div class="nk-block">
                            <span style="font-weight: bold">Date and Time: {{\Carbon\Carbon::parse($transaction['created_at'])->toDateTimeString()}}</span>
                            <div class="card card-bordered">
                                <div class="nk-kycfm">
                                    <div class="" style="display: flex; flex-direction:column; align-items:center; justify-content:center">
                                        <div class="nk-kycfm-title" style="margin: 20px 0;">
                                            <h5 class="title">Transaction Details</h5>
                                        </div>
                                        <div class="nk-kycfm-title">
                                            @if($transaction['trans_type'] == config('constants.trans_types.withdraw'))
                                            <span class="badge badge-pill badge-md badge-danger" style="font-weight: bold;">{{$transaction['trans_type']}} Transaction</span>
                                            @else
                                            <span class="badge badge-pill badge-md badge-success" style="font-weight: bold;">{{$transaction['trans_type']}} Transaction</span>
                                            @endif
                                        </div>
                                    </div><!-- .nk-kycfm-head -->
                                    <div class="nk-kycfm-content">
                                        <div class="row g-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">First Name</label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" class="form-control form-control-lg" value="{{$transaction['user']['firstname']}}" disabled>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Last Name</label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" class="form-control form-control-lg" value="{{$transaction['user']['lastname']}}" disabled>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Purpose</label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" class="form-control form-control-lg" style="text-transform:capitalize" value="{{$value}}" disabled>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Amount</label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        @if($transaction['trans_type'] == config('constants.trans_types.withdraw'))
                                                        <input type="text" class="form-control form-control-lg text-danger" style="font-weight: bolder;" value=" - NGN {{number_format($transaction['amount'], 2)}}" disabled>
                                                        @else
                                                        <input type="text" class="form-control form-control-lg text-success" style="font-weight: bolder;" value="NGN {{number_format($transaction['amount'], 2)}}" disabled>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Payment Method</label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" class="form-control form-control-lg" value="{{$transaction['payment_method']}}" disabled>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Previous Balance</label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" class="form-control form-control-lg" value="NGN {{number_format($transaction['prev_bal'])}}" disabled>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">New Balance</label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" class="form-control form-control-lg" value="NGN {{number_format($transaction['new_bal'])}}" disabled>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                        </div><!-- .row -->
                                    </div><!-- .nk-kycfm-content -->
                                </div><!-- .nk-kycfm -->
                            </div><!-- .card -->
                        </div><!-- nk-block -->

                        <div class="nk-block nk-block-lg d-flex justify-content-center">
                        <a href="{{route('reciept.print', ['id' => $transaction['id'], 'type' => 'transaction'])}}" class="btn btn-primary">Download Receipt</a>
                            <!-- <button class="btn btn-danger btn-lg" onclick="showModal('{{ $transaction->purpose }}', '{{ $transaction->id }}')">Delete Transaction</button> -->
                        </div>
                    </div><!-- kyc-app -->
                </div>
            </div>
        </div>
        <!-- content @e -->

    </div>
</div>
@stop