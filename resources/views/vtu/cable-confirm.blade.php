<?php
$title = 'Cable TV Subscription';
?>
@extends('layout')
@section('contents')

<div class="container-xl wide-lg">
    <div class="nk-content-body">
        <div class="nk-block-head">
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">Confirm Details</h2>
                </div>
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <!-- content @s -->
        <div class="nk-content-body">
            <div class="kyc-app wide-lg m-auto">
                <div class="nk-block">
                    <div class="card card-bordered" style="padding: 2rem;">
                        <div class="alert alert-secondary">
                            <div class="alert-cta flex-wrap flex-md-nowrap">
                                <div style="font-weight: bolder;">
                                    <p>Please verify and confirm the details of your transaction before you proceed</p>
                                </div>
                                <ul class="alert-actions gx-3 mt-3 mb-1 my-md-0">
                                    <li class="order-md-last">
                                        <a href="{{route('cable')}}?serviceID={{session('serviceID')}}" class="btn btn-sm btn-danger">Cancel</a>
                                    </li>
                                    <li class="order-md-last">
                                        <form onsubmit="document.getElementById('submit-btn-btn').disabled = true" action="{{route('submit-cable')}}" method="POST">
                                            @csrf
                                            <button type="submit" id="submit-btn-btn" class="btn btn-lg btn-primary">Proceed</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .alert -->
                        <div class="row d-flex justify-content-center nk-data data-list">
                            <div class="col-lg-6 data-item">
                                <div class="data-col">
                                    <span class="data-label">Email: </span>
                                    <span class="data-value" style="font-weight: bolder; font-size:18px">{{$user['email']}}</span>
                                </div>
                            </div><!-- .data-item -->
                            <div class="col-lg-6 data-item">
                                <div class="data-col">
                                    <span class="data-label">Phone: </span>
                                    <span class="data-value" style="font-weight: bolder; font-size:18px">{{session('phone')}}</span>
                                </div>
                            </div><!-- .data-item -->
                            <div class="col-lg-6 data-item">
                                <div class="data-col">
                                    <span class="data-label">Selected Bouquet: </span>
                                    <span class="data-value" style="font-weight: bolder; font-size:18px">{{session('plan')}}</span>
                                </div>
                            </div><!-- .data-item -->
                            <div class="col-lg-6 data-item">
                                <div class="data-col">
                                    <span class="data-label">Amount to Pay: </span>
                                    <span class="data-value" style="font-weight: bolder; font-size:18px">NGN {{number_format(session('chargedAmount'),2)}}</span>
                                </div>
                            </div><!-- .data-item -->
                            <div class="col-lg-6 data-item">
                                <div class="data-col">
                                    @if(session('serviceID') == "dstv")
                                    <span class="data-label">DSTV SmartCard Number: </span>
                                    @elseif(session('serviceID') == "gotv")
                                    <span class="data-label">GOTV IUC Number: </span>
                                    @elseif(session('serviceID') == "startimes")
                                    <span class="data-label">Startimes Smartcard/ewallet Number: </span>
                                    @endif
                                    <span class="data-value" style="font-weight: bolder; font-size:18px">{{session('billersCode')}}</span>
                                </div>
                            </div><!-- .data-item -->
                            <div class="col-lg-6 data-item">
                                <div class="data-col">
                                    <span class="data-label">Customer's Name: </span>
                                    <span class="data-value" style="font-weight: bolder; font-size:18px">{{session('billersName')}}</span>
                                </div>
                            </div><!-- .data-item -->
                            @if(session('serviceID') == "dstv" || session('serviceID') == "gotv")
                            <div class="col-lg-6 data-item">
                                <div class="data-col">
                                    <span class="data-label">Current Bouquet </span>
                                    <span class="data-value" style="font-weight: bolder; font-size:18px">{{session('billersBouquet')}}</span>
                                </div>
                            </div><!-- .data-item -->
                            <div class="col-lg-6 data-item">
                                <div class="data-col">
                                    <span class="data-label">Subscription Type </span>
                                    <span class="data-value" style="font-weight: bolder; font-size:18px">{{session('subscription_type')}}</span>
                                </div>
                            </div><!-- .data-item -->
                            @endif
                        </div><!-- .nk-data -->
                    </div>
                </div>
            </div>
        </div>
        <!-- content @e -->
    </div>
</div>

@stop