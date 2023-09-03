<?php

use App\Models\User;
use App\Traits\Generics;

$title = 'Wallet';
?>

@extends('layout')
@section('contents')
<div class="container-xl wide-lg">
    <div class="nk-content-body">
        <div class="nk-block-head">
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">Referral Management</h2>
                </div>
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <div class="card card-bordered">
                <div class="nk-refwg">
                    <div class="nk-refwg-invite card-inner">
                        <div class="nk-refwg-head g-3">
                            <div class="nk-refwg-title">
                                <h5 class="title">Refer to Earn more</h5>
                                <div class="title-sub">Use the bellow link to invite your friends.</div>
                            </div>
                        </div>
                        <div class="nk-refwg-url">
                            <div class="form-control-wrap">
                                <div class="form-clip clipboard-init" data-clipboard-target="#refUrl" data-success="Copied" data-text="Copy Link"><em class="clipboard-icon icon ni ni-copy"></em> <span class="clipboard-text">Copy Link</span></div>
                                <div class="form-icon">
                                    <em class="icon ni ni-link-alt"></em>
                                </div>
                                <input type="text" class="form-control copy-text" id="refUrl" value="{{route('register')}}?ref={{$user['my_ref_code']}}">
                            </div>
                        </div>
                    </div><!-- .nk-refwg-invite -->
                    <div class="nk-refwg-stats card-inner bg-lighter">
                        <div class="nk-refwg-group g-3">
                            <div class="nk-refwg-name">
                                <h6 class="title">My Referral <em class="icon ni ni-info" data-toggle="tooltip" data-placement="right" title="Referral Informations"></em></h6>
                            </div>
                            <div class="nk-refwg-info g-3">
                                <div class="nk-refwg-sub">
                                    <div class="title">{{number_format($user['no_of_referrals'])}}</div>
                                    <div class="sub-text">Direct Referrals</div>
                                </div>
                                <div class="nk-refwg-sub">
                                    <div class="title">₦{{number_format($user['wallet']['ref_commission'], 2)}}</div>
                                    <div class="sub-text">Referral Commission</div>
                                </div>
                            </div>
                        </div>
                        <div class="nk-refwg-ck">
                            <canvas class="chart-refer-stats" id="refBarChart"></canvas>
                        </div>
                    </div><!-- .nk-refwg-stats -->
                </div><!-- .nk-refwg -->
            </div><!-- .card -->
        </div><!-- .nk-block -->

        <div class="nk-block nk-block-lg" style="margin-top: 3rem;">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <a href="{{route('referral')}}"><em class="ni ni-back-alt"></em> Back to Referrals</a>
                    <h4> <span>{{$referrer->full_name}}</span> - Downlines</h4>
                </div>
            </div>

            @if($referrals->isEmpty())
                <div class="card-body">
                    <div class="alert alert-warning">
                        <p style="text-align: center;">
                            You do not have any referrals yet!!
                        </p>
                    </div>
                </div>
            @else
            
            <div class="card card-bordered card-preview table-responsive">
                <table class="table table-orders">
                    <thead class="tb-odr-head">
                        {{-- 
                            <?php
                                $refBy = User::where('my_ref_code', $item->refer_by)->first();
                                $position = $item->getPositionOnDownline(auth()->user());
                            ?> 

                            <!-- <td class="tb-odr-info">
                                @if($position==1)
                                <span class="tb-odr-id" style="font-weight: bold;">Direct Referral</span>
                                @else
                                <span class="tb-odr-id" style="font-weight: bold;">{{position($position)}} Level</span>
                                @endif
                            </td> -->

                        --}}
                        <tr class="tb-odr-item">
                            <th >
                                S/N
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Fullname</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Email Address</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Phone Number</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Current Plan</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Downline Level</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Referred By</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Date Joined</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="tb-odr-body">
                        @foreach($referrals as $key => $item)
                            <?php
                                // $refBy = User::where('my_ref_code', $item->refer_by)->first();
                                $position = $item->getPositionOnDownline(auth()->user());
                            ?> 

                            

                        <tr class="tb-odr-item">
                            <td >{{ $key+1 }}</td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{$item->fullname}}</span>
                            </td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{$item->email}}</span>
                            </td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{$item->phone}}</span>
                            </td>
                            
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{$item->plan->package_name}}</span>
                            </td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{position($position)}} Level</span>
                            </td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{$item->referrer->fullname}}</span>
                            </td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{ Date::parse($item->created_at)->format('jS F Y') }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- .card-preview -->
            @endif
        </div><!-- nk-block -->
    </div>
</div>
@stop