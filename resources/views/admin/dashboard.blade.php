<?php
$title = 'Dashboard';
?>

@extends('layout')
@section('contents')

    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                        <h2 class="nk-block-title fw-normal">Overview</h2>
                      <span class="badge badge-primary badge-pill badge-lg">{{$user->plan->package_name}}</span>
                    </div>
                </div>
            </div>

            <div class="nk-block">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card card-bordered text-light is-dark h-100">
                            <div class="card-inner">
                                <div class="nk-wg7">
                                    <div class="d-flex justify-content-between">
                                        <div class="nk-wg7-stats w-100">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="nk-wg7-title">Total Users</div>
                                            </div>
                                            <div class="number-lg amount">{{App\Models\User::isNotAdmin()->count()}}</div>
                                        </div>
                                        <div class="nk-wg7-stats">
                                        </div>
                                    </div>
                                </div><!-- .nk-wg7 -->
                            </div><!-- .card-inner -->
                        </div>
                    </div>
                  
                  <div class="col-md-4">
                        <div class="card card-bordered text-light is-dark h-100">
                            <div class="card-inner">
                                <div class="nk-wg7">
                                    <div class="d-flex justify-content-between">
                                        <div class="nk-wg7-stats w-100">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="nk-wg7-title">Total Withdrawals</div>
                                            </div>
                                            <div class="number-lg amount">{{number_format($withdrawals)}}</div>
                                        </div>
                                        <div class="nk-wg7-stats"></div>
                                    </div>
                                </div><!-- .nk-wg7 -->
                            </div><!-- .card-inner -->
                        </div>
                    </div>
                  
                  <div class="col-md-4">
                        <div class="card card-bordered text-light is-dark h-100">
                            <div class="card-inner">
                                <div class="nk-wg7">
                                    <div class="d-flex justify-content-between">
                                        <div class="nk-wg7-stats w-100">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="nk-wg7-title">Total Deposits</div>
                                            </div>
                                            <div class="number-lg amount">₦{{number_format($deposits)}}</div>
                                        </div>
                                        <div class="nk-wg7-stats"></div>
                                    </div>
                                </div><!-- .nk-wg7 -->
                            </div><!-- .card-inner -->
                        </div>
                    </div>
              
              <div class="col-md-4">
                        <div class="card card-bordered text-light is-dark h-100">
                            <div class="card-inner">
                                <div class="nk-wg7">
                                    <div class="d-flex justify-content-between">
                                        <div class="nk-wg7-stats w-100">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="nk-wg7-title">Total Point Value</div>
                                            </div>
                                            <div class="number-lg amount">{{number_format($pv)}}</div>
                                        </div>
                                        <div class="nk-wg7-stats"></div>
                                    </div>
                                </div><!-- .nk-wg7 -->
                            </div><!-- .card-inner -->
                        </div>
                    </div>
          
          		<div class="col-md-4">
                        <div class="card card-bordered text-light is-dark h-100">
                            <div class="card-inner">
                                <div class="nk-wg7">
                                    <div class="d-flex justify-content-between">
                                        <div class="nk-wg7-stats w-100">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="nk-wg7-title">Total Cashback</div>
                                            </div>
                                            <div class="number-lg amount">₦{{number_format($cashback)}}</div>
                                        </div>
                                        <div class="nk-wg7-stats"></div>
                                    </div>
                                </div><!-- .nk-wg7 -->
                            </div><!-- .card-inner -->
                        </div>
                    </div>
                </div>  
              
                </div>
        </div>
    </div>

@stop