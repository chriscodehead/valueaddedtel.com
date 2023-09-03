<?php
$title = 'Pay Educational Bills';
?>
@extends('layout')
@section('contents')

<div class="container-xl wide-lg">
    <div class="nk-content-body">
        <div class="nk-block-head">
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">Pay Educational Bills</h2>
                </div>
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <!-- content @s -->
        <div class="nk-content-body">
            <div class="kyc-app wide-lg m-auto">
                <div class="nk-block">
                    @include('components.upgrade-account')

                    <div class="row row-cols-md-3 g-3">
                      @if(isset($waecReg))
                        <div>
                            <a href="{{route('education.service', ['service_id' => $waecReg['service']])}}" class="card btn bg-hover-opacity-10 bg-hover-light align-items-start text-left card-bordered h-100">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3 px-0">
                                            <img src="{{asset('waec-logo.jpg')}}" class="img-fluid mx-0" />
                                        </div>
                                        <div class="col-9 d-flex justify-content-center flex-column">
                                            <p class="fs-4 mb-0 fw-bold">{{$waecReg['name']}}</p>
                                            <!-- <p>WAEC Result Checking PIN / Scratch Card</p> -->
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                      @if(isset($waec))
                        <div>
                            <a href="{{route('education.service', ['service_id' => $waec['service']])}}" class="card btn bg-hover-opacity-10 bg-hover-light align-items-start text-left card-bordered h-100">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3 px-0">
                                            <img src="{{asset('waec-logo.jpg')}}" class="img-fluid mx-0" />
                                        </div>
                                        <div class="col-9 d-flex justify-content-center flex-column">
                                            <p class="fs-4 mb-0 fw-bold">{{$waec['name']}}</p>
                                            <!-- <p>WAEC Result Checking PIN / Scratch Card</p> -->
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                      @if(isset($jamb))
                        <div>
                            <a href="{{route('education.service', ['service_id' => $jamb['service']])}}" class="card btn bg-hover-opacity-10 bg-hover-light align-items-start text-left card-bordered h-100">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-3 px-0">
                                            <img src="{{asset('jamb-logo.png')}}" class="img-fluid w-75" />
                                        </div>
                                        <div class="col-9 d-flex justify-content-center flex-column">
                                            <p class="fs-4 mb-0 fw-bold">{{$jamb['name']}}</p>
                                            <!-- <p>Jamb Registration Pin / Scratch Card</p> -->
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                      @endif
                    </div>
                </div><!-- nk-block -->
                <div class="nk-block nk-block-lg" style="margin-top: 3rem;">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4>Payment History</h4>
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
                                        <span class="tb-odr-id">₦{{number_format($item->amount, 2)}}</span>
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