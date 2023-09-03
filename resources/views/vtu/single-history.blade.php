<?php

$title = 'TopUp Details';
?>

@extends('layout')
@section('contents')
<div class="container-xl wide-lg">
    <div class="nk-content-body">
        <div class="nk-block-head">
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">Details</h2>
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
                                        
                                        @if($transaction->code)
                                            <div class="mb-4 text-center">
                                                <p class="mb-0">Purchased Token</p>
                                                <h3 class="">{{$transaction->code}}</h3>
                                                <button onclick="event.target.innerHTML = 'Copied'; navigator.clipboard.writeText('{{$transaction->code}}'); setTimeout(() => event.target.innerHTML = 'Copy', 1000);" class="btn btn-sm btn-success btn-dim">Copy</button>
                                            </div>
                                        @endif
                                        
                                        <div class="nk-kycfm-title">
                                            <span class="badge badge-pill badge-md badge-primary" style="font-weight: bold; text-transform:capitalize"><?php echo implode(' ', explode('_', $transaction['service'])) ?></span>
                                        </div>
                                    </div><!-- .nk-kycfm-head -->
                                    <div class="nk-kycfm-content">
                                        <div class="row g-4 justify-content-center">
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
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Phone</label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" class="form-control form-control-lg" value="{{$transaction['phone']}}" disabled>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                            @if($transaction['service'] == config('constants.services.airtime') || $transaction['service'] == config('constants.services.data'))
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Network</label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" class="form-control form-control-lg text-uppercase" style="font-weight: bolder;" value="{{$transaction['network']}}" disabled>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                            @endif
                                            @if($transaction['service'] == config('constants.services.data') || $transaction['service'] == config('constants.services.cable'))
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Plan</label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" class="form-control form-control-lg" style="font-weight: bolder;" value="{{$transaction['vtu_plan']}}" disabled>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                            @endif
                                          	@if($transaction['service'] == config("constants.services.electricity"))
                                          		@php
                                          			$electricity = $transaction->electricity;
                                          		@endphp
                                          		
                                          		@isset($electricity->customer_name)
                                                  <div class="col-md-6">
                                                      <div class="form-group">
                                                          <div class="form-label-group">
                                                              <label class="form-label">Customer Name</label>
                                                          </div>
                                                          <div class="form-control-group">
                                                              <input type="text" class="form-control form-control-lg" style="font-weight: bolder;" value="{{$electricity['customer_name']}}" disabled>
                                                          </div>
                                                      </div>
                                                  </div><!-- .col -->
                                          		@endisset
                                          
                                                @isset($electricity->address)
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <div class="form-label-group">
                                                      <label class="form-label">Customer Address</label>
                                                    </div>
                                                    <div class="form-control-group">
                                                      <input type="text" class="form-control form-control-lg" style="font-weight: bolder;" value="{{$electricity['address']}}" disabled>
                                                    </div>
                                                  </div>
                                                </div><!-- .col -->
                                                @endisset
                                          	@endif
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Amount</label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" class="form-control form-control-lg" style="font-weight: bolder;" value="NGN {{number_format($transaction['amount'], 2)}}" disabled>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Payment Method</label>
                                                    </div>
                                                    <div class="form-control-group">
                                                        <input type="text" class="form-control form-control-lg text-capitalize" value="{{$transaction['payment_method']}}" disabled>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                        </div><!-- .row -->
                                    </div><!-- .nk-kycfm-content -->
                                </div><!-- .nk-kycfm -->
                            </div><!-- .card -->
                        </div><!-- nk-block -->

                        <div class="nk-block nk-block-lg d-flex justify-content-center">
                            <a href="{{route('reciept.print', ['id' => $transaction['id'], 'type' => 'vtu_history'])}}" class="btn btn-primary">Download Receipt</a>
                            <!-- <button class="btn btn-danger btn-lg" onclick="showDeleteHistoryModal('{{ $transaction->id }}')">Delete Record</button> -->
                        </div>
                    </div><!-- kyc-app -->
                </div>
            </div>
        </div>
        <!-- content @e -->

    </div>
</div>
@stop