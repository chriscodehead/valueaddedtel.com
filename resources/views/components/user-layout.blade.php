<?php
    $title = 'Users';
?>

@extends('layout')

@section('contents')
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Users / <strong class="text-primary small">{{$selectedUser->full_name}}</strong></h3>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{route('admin.users')}}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                            <a href="{{route('admin.users')}}" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered rounded-0">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card-inner">
                                    <div class="user-card user-card-s2">
                                        <div class="user-avatar lg bg-primary">
                                            <span>AB</span>
                                        </div>
                                        <div class="user-info">
                                            <div class="badge badge-success badge-pill ucap">{{$selectedUser->plan->package_name}}</div>
                                            <h5>{{$selectedUser->full_name}}</h5>
                                            <span class="sub-text">{{$selectedUser->email}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="card-inner">
                                    <button data-toggle="modal" data-target="#deposit-modal" class="btn btn-primary mr-2">Deposit</button>
                                    <button data-toggle="modal" data-target="#withdraw-modal" class="btn btn-warning mr-2">Withdraw</button>
                                    <button data-toggle="modal" data-target="#withdraw-pv-modal" class="btn btn-success mr-2">Withdraw PV</button>

                                    @include('components.modals.admin-withdrawal', ['selectedUser' => $selectedUser])
                                    @include('components.modals.admin-deposit', ['selectedUser' => $selectedUser])
                                    @include('components.modals.admin-withdraw-pv', ['selectedUser' => $selectedUser])
                                </div>
                              
                                <div class="card-inner">
                                  @if(!$selectedUser->isVerified)
                                  	<x-swal href="{{route('admin.user.verify-email', ['user' => $selectedUser])}}" class="btn btn-primary mr-2">Verify Email</x-swal>
                                  @endif
                                  <x-swal href="{{route('admin.user.status', ['user' => $selectedUser])}}"  class="btn btn-warning mr-2"> {{ $selectedUser->status ? 'Suspend' : 'Restore'}} User</x-swal>
                                  <x-swal href="{{route('admin.user.delete', ['user' => $selectedUser])}}" class="btn btn-danger mr-2">Delete Account</x-swal>
                                </div>


                                <div class="card-inner">
                                    <div class="overline-title-alt mb-2">Wallet Balance</div>
                                    <div class="profile-balance">
                                        <div class="profile-balance-group gx-4">
                                            <div class="profile-balance-sub">
                                                <div class="profile-balance-amount">
                                                    <div class="number"><x-naira /> {{$selectedUser->wallet->main_balance}}</div>
                                                </div>
                                                <div class="profile-balance-subtitle">Main Balance</div>
                                            </div>
                                            <div class="profile-balance-sub">
                                                <div class="profile-balance-amount">
                                                    <div class="number"><x-naira /> {{$selectedUser->wallet->cash_back}}</div>
                                                </div>
                                                <div class="profile-balance-subtitle">Cashback</div>
                                            </div>
                                            <div class="profile-balance-sub">
                                                <div class="profile-balance-amount">
                                                    <div class="number">{{$selectedUser->wallet->points}}</div>
                                                </div>
                                                <div class="profile-balance-subtitle">PV</div>
                                            </div>
                                            <div class="profile-balance-sub">
                                                <div class="profile-balance-amount">
                                                    <div class="number"><x-naira /> {{$selectedUser->wallet->ref_commission}}</div>
                                                </div>
                                                <div class="profile-balance-subtitle">Referral Earnings</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
                    <div class="card card-bordered rounded-0 border-top-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-content " >
                                    <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="{{route('admin.users.details', ['user' => $selectedUser->username])}}"><em class="icon ni ni-user-circle"></em><span>Personal</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.users.referrals', ['user' => $selectedUser->username])}}"><em class="icon ni ni-users"></em><span>Referrals</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.users.transactions', ['user' => $selectedUser->username])}}"><em class="icon ni ni-repeat"></em><span>Transactions</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.users.vtuHistory', ['user' => $selectedUser->username])}}"><em class="icon ni ni-file-text"></em><span>VTU History</span></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('admin.users.profile', ['user' => $selectedUser->username])}}"><em class="icon ni ni-user"></em><span>Profile</span></a>
                                        </li>
                                    </ul>
                                    <div class="card-inner">
                                        {{$slot}}
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-aside-wrap -->
                    </div><!-- .card -->
                </div>
        </div>
    </div>
@stop