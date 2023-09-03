<?php
$title = 'Pay Electricity Bills';
?>
@extends('layout')
@section('contents')

<div class="container-xl wide-lg">
    <div class="nk-content-body">
        <div class="nk-block-head">
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">Pay Electricity Bills</h2>
                </div>
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <!-- content @s -->
        <div class="nk-content-body">
            <div class="kyc-app wide-lg m-auto">
                <div class="nk-block">
                    @include('components.upgrade-account')

                    <div class="card card-bordered">
                        <div class="nk-kycfm">
                            <div class="nk-kycfm-content">
                                <x-form-swal warning="Proceed with electricy bill payment?" id="eclectricty-bill-form" action="{{route('electricity.buy')}}" method="POST">
                                    @csrf
                                    <div class="row g-4 d-flex justify-content-center">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Electricity Company</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <select name="company" class="form-control form-control-lg" id="company" required>
                                                        <option value="">Select Company</option>
                                                        @foreach($companies as $item)
                                                        <option value="{{$item->id}}" class="form-control form-control-lg">{{$item->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Meter Type</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <select name="type" class="form-control form-control-lg" id="meter" required>
                                                        <option value="">Select Meter Type</option>
                                                        <option value="prepaid" class="form-control form-control-lg">Prepaid</option>
                                                        <option value="postpaid" class="form-control form-control-lg">Postpaid</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Meter Number</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <input name="meter_no" class="form-control form-control-lg" placeholder="Enter Meter No." required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Amount</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <input type="number" id="amount" name="amount" class="form-control form-control-lg" placeholder="Enter Amount" required>
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Select Payment Method</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control form-control-lg" name="payment_method" required>
                                                        <option value="">Select Here</option>
                                                        <option value="wallet" default>Wallet - NGN{{number_format($user['wallet']['main_balance'], 2)}}</option>
                                                        <!-- <option value="flw" default>Flutterwave</option> -->
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
                                                    <button type="submit" class="btn btn-lg btn-primary" id="submit-btn">Purchase Credits</button>
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
                            <h4>Electricity Billing History</h4>
                        </div>
                    </div>
                    @if($vtu_histories->isEmpty())
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <p style="text-align: center;">
                                There are currently no airtime transactions yet from the account!!!
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
                                        <span class="tb-odr-id">Provider</span>
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
                                        <span class="tb-odr-id">{{number_format($item->amount, 2)}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id" style="text-transform: capitalize;">{{$item->payment_method}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id" style="text-transform: uppercase;">{{$item->network}}</span>
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
                                        <div class="tb-odr-btns d-md-inline">
                                            <button data-toggle="modal" data-target="#token-modal-{{$item->id}}" class="btn btn-sm btn-primary">View Token</button>
                                        </div>

                                        <x-modal id="token-modal-{{$item->id}}">
                                            <div x-data="{copy: 'Copy'}" class="text-center">
                                                <p>Your Purchased token is</p>
                                                <h5>{{$item->code}}</h5>
                                                <button x-on:click="copy='Copied';window.navigator.clipboard.writeText('{{$item->code}}');setTimeout(() => copy='Copy', 1000)" class="btn btn-primary btn-dim" x-text="copy" ></button>
                                            </div>
                                        </x-modal>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- .card-preview -->
                    <div class="row d-flex justify-content-center" style="margin-top: 1rem;">
                        {{ $vtu_histories->appends(['vtu_histories'=>$vtu_histories->currentPage()])->links() }}
                    </div>
                    @endif
                </div><!-- nk-block -->
            </div><!-- kyc-app -->
        </div>
        <!-- content @e -->
    </div>
</div>
@stop