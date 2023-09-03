<?php
$title = 'Upgrade Package';
?>

@extends('layout')
@section('contents')
<div class="container-xl wide-lg">
    <div class="nk-content-body">
        <div class="components-preview mx-auto">
            <div class="nk-block-head nk-block-head-lg wide-sm">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title fw-normal">Select your preferred membership package plan </h4>
                </div>
            </div><!-- nk-block-head -->

            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <p>The following table contains the list of <strong class="text-primary">all available membership package plans</strong> on {{env('APP_NAME')}}</p>
                    </div>
                </div>
                <div class="card card-bordered card-preview table-responsive">
                    <table class="table table-orders">
                        <thead class="tb-odr-head">
                            <tr class="tb-odr-item">
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">S/N</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Plan name</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Registration Fee</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Registration Bonus</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Max Commission Level</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">PV Quantity (PV)</span>
                                </th>
                                <th class="tb-odr-info">Action</th>
                            </tr>
                        </thead>
                        <tbody class="tb-odr-body">
                            @foreach($allPlans as $key=>$item)
                            <tr class="tb-odr-item">
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id">{{ $key+1 }}</span>
                                </td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id" style="font-weight: bold;">{{$item->package_name}}</span>
                                </td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id">₦{{number_format($item->reg_fee, 2)}}</span>
                                </td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id">₦{{number_format($item->reg_bonus, 2)}}</span>
                                </td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id">{{$item->level_commission}}</span>
                                </td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id">{{$item->point_value}}</span>
                                </td>
                                <td class="tb-tnx-info">
                                    <div class="dropdown">
                                        @if($user['plan_id'] == $item->id)
                                        <a href="#" class="dropdown-toggle btn btn-sm btn-secondary" style="pointer-events: none;">Current Plan</a>
                                        @else
                                        <a href="#" class="dropdown-toggle btn btn-sm btn-primary" data-toggle="dropdown">Choose Plan</a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="link-list-plain">
                                                @if (\App\Models\Settings::first()->enable_paystack)  
                                                    <li><a href="purchase-plan-paystack/{{$item->id}}">Pay with Paystack</a></li>
                                                @endif
                                                <li><a href="#" data-toggle="modal" data-target="#payWithWallet" data-id="{{ $item->id }}">Pay with Wallet</a></li>
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- .card-preview -->
            </div><!-- nk-block -->
        </div><!-- .components-preview -->
    </div>
</div>
@stop