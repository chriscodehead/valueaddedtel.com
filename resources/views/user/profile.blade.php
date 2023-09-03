<?php

$title = 'Account Profile';
if ($user['refer_by'] !== null) {
    $ref = App\Models\User::where('my_ref_code', $user['refer_by'])->first();
} else {
    $ref['fullname'] = "None";
}
?>

@extends('layout')
@section('contents')
<div class="container-xl wide-lg">
    <div class="nk-content-body">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">My Profile</h2>
            </div>
        </div><!-- .nk-block-head -->
        <!-- NK-Block @s -->
        <div class="nk-block">
            <div class="alert alert-info">
                <div class="alert-cta flex-wrap flex-md-nowrap">
                    <div class="alert-text">
                        <p>You have full control to manage your own account setting.</p>
                    </div>
                    <ul class="alert-actions gx-3 mt-3 mb-1 my-md-0">
                        @if (!$user->is_admin)
                            <li class="order-md-last">
                                <a href="{{route('upgrade')}}" class="btn btn-sm btn-secondary">Upgrade Plan</a>
                            </li>
                        @endif
                        <li class="order-md-last">
                            <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#profile-edit">Edit Profile</a>
                        </li>
                    </ul>
                </div>
            </div><!-- .alert -->
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">Personal Information</h5>
                    <div class="nk-block-des">
                        <p>Basic info, like your name and address, that you use on {{env('APP_NAME')}}.</p>
                    </div>
                </div>
            </div><!-- .nk-block-head -->
            <div class="nk-data data-list">
                <div class="data-head">
                    <h6 class="overline-title">Basics</h6>
                </div>
                <div class="data-item">
                    <div class="data-col">
                        <span class="data-label">Level Eligibility</span>
                        <span class="data-value">Upto {{$user['plan']['level_commission']}} Levels of Referrals</span>
                    </div>
                    <div class="data-col data-col-end"></div>
                </div><!-- .data-item -->
                <div class="data-item">
                    <div class="data-col">
                        <span class="data-label">Full Name</span>
                        <span class="data-value">{{$user['fullname']}}</span>
                    </div>
                    <div class="data-col data-col-end"></div>
                </div><!-- .data-item -->
                <div class="data-item">
                    <div class="data-col">
                        <span class="data-label">Username</span>
                        <span class="data-value">{{$user['username']}}</span>
                    </div>
                    <div class="data-col data-col-end"></div>
                </div><!-- .data-item -->
                <div class="data-item">
                    <div class="data-col">
                        <span class="data-label">First Name</span>
                        <span class="data-value">{{$user['firstname']}}</span>
                    </div>
                    <div class="data-col data-col-end"></div>
                </div><!-- .data-item -->
                <div class="data-item">
                    <div class="data-col">
                        <span class="data-label">Last Name</span>
                        <span class="data-value">{{$user['lastname']}}</span>
                    </div>
                    <div class="data-col data-col-end"></div>
                </div><!-- .data-item -->
                <div class="data-item">
                    <div class="data-col">
                        <span class="data-label">Email</span>
                        <span class="data-value">{{$user['email']}}</span>
                    </div>
                    <div class="data-col data-col-end"></div>
                </div><!-- .data-item -->
                <div class="data-item">
                    <div class="data-col">
                        <span class="data-label">Phone Number</span>
                        <span class="data-value">{{$user['phone']}}</span>
                    </div>
                    <div class="data-col data-col-end"></div>
                </div>
                @if (!$user->is_admin)                    
                    <div class="data-item">
                        <div class="data-col">
                            <span class="data-label">Referred by</span>
                            <span class="data-value" style="font-style:italic; font-weight:bold">{{$ref['username']}}</span>
                        </div>
                        <div class="data-col data-col-end"></div>
                    </div><!-- .data-item -->
                @endif
            </div><!-- .nk-data -->
            @if (!$user->is_admin)
                <div class="nk-data data-list">
                    <div class="data-head">
                        <h6 class="overline-title">Bank Details</h6>
                    </div>
                    <div class="data-item">
                        <div class="data-col">
                            <span class="data-label">Account Name</span>
                            <span class="data-value">{{$user['account_name']}}</span>
                        </div>
                        <div class="data-col data-col-end"></div>
                    </div><!-- .data-item -->
                    <div class="data-item">
                        <div class="data-col">
                            <span class="data-label">Account Number</span>
                            <span class="data-value">{{$user['account_number']}}</span>
                        </div>
                        <div class="data-col data-col-end"></div>
                    </div><!-- .data-item -->
                    <div class="data-item">
                        <div class="data-col">
                            <span class="data-label">Bank</span>
                            <span class="data-value">{{$user['bank_name']}}</span>
                        </div>
                        <div class="data-col data-col-end"></div>
                    </div><!-- .data-item -->
                </div><!-- .nk-data -->
            @endif
        </div>
    </div>
</div>
@stop