<?php
    use App\Models\User;
    use App\Traits\Generics;

    $title = 'Referrals';
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
                </div>
            </div>
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
                        <div class="nk-refwg-stats card-inner">
                            <div class="nk-refwg-group g-3">
                                <div class="nk-refwg-name d-flex align-items-center">
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

                            @if($user->referrer)
                                <div class="">
                                    <div class="mt-3">
                                        <div class="mb-2"><h6>Account Sponsor</h6></div>
                                        <div class="card-inner bg-lighter p-3 px-4 rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar md bg-primary">
                                                    @if($user->image)
                                                        <img src="{{$user->referrer->image}}" alt="">
                                                    @else
                                                        <span class="fs-1">
                                                        {{str_split($user->referrer->full_name)[0]}}
                                                        </span>
                                                    @endif
                                                    <div class="status dot dot-lg dot-success"></div>
                                                </div>
                                                <div class="user-info ml-2">
                                                    <div>
                                                        <h6 class="mb-0">{{$user->referrer->full_name}}</h6>
                                                        <span class="sub-text">{{'@'}}{{$user->referrer->username}}</span>
                                                    </div>

                                                    <div class="d-flex align-items-center">
                                                        <em class="ni ni-call-alt mr-1 icon"></em>
                                                        <a href="tel:{{$user->referrer->phone}}">{{$user->referrer->phone}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div><!-- .nk-refwg -->
                </div><!-- .card -->
            </div>

            <div class="nk-block nk-block-lg" style="margin-top: 3rem;">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4>My Referral Team</h4>
                    </div>
                </div>
                @if($referralTable->isEmpty())
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
                                <!-- <th class="tb-odr-info">
                                    <span class="tb-odr-id">Referral Level</span>
                                </th> -->
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Current Plan</span>
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
                            @foreach($referralTable as $key => $item)
                                @if($item->user)
                                    <tr class="tb-odr-item">
                                <td >{{ $key+1 }}</td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id" style="font-weight: bold;">{{$item->user->fullname}}</span>
                                    <br>
                                    @if ($item->user->referrer)
                                        <a href="{{route('referral.downlines', ['user' => $item->user->username])}}" class="btn btn-primary btn-dim btn-xs">Team View</a>
                                    @endif
                                </td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id" style="font-weight: bold;">{{$item->user->email}}</span>
                                </td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id" style="font-weight: bold;">{{$item->user->phone}}</span>
                                </td>

                                <td class="tb-odr-info">
                                    <span class="tb-odr-id" style="font-weight: bold;">{{$item->user->plan->package_name}}</span>
                                </td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id" style="font-weight: bold;">{{$item->user->referrer?->fullname}}</span>
                                </td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id" style="font-weight: bold;">{{ Date::parse($item->created_at)->format('jS F Y') }}</span>
                                </td>
                            </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- .card-preview -->
                @endif
            </div>
        </div>
    </div>
@stop
