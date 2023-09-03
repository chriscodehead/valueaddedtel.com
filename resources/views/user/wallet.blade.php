<?php
$title = 'Wallet';
?>

@extends('layout')
@section('contents')
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                        <h2 class="nk-block-title fw-normal">Wallet Information</h2>
                    </div>
                    <div class="nk-block-head-content">
                        <ul class="nk-block-tools gx-3">
                            <li>
                                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#modalForm"><em class="icon ni ni-wallet-in"></em> <span>Top Up</span></button>
                            </li>
                            <li>
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#transferForm"><em class="icon ni ni-wallet-out"></em> <span>Transfer</span></button>
                            </li>
                            <li><button data-toggle="modal" data-target="#withdrawalForm" class="btn btn-dim btn-outline-light"><em class="icon ni ni-wallet-out"></em> <span>Withdraw</span></a></li>
                        </ul>
                    </div>
                </div><!-- .nk-block-between -->
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="row g-gs">
                    <div class="col-sm-6 col-lg-4 col-xl-6 col-xxl-4">
                        <div class="card card-bordered is-dark">
                            <div class="nk-wgw">
                                <div class="nk-wgw-inner">
                                    <div class="nk-wgw-name">
                                        <div class="nk-wgw-icon is-default">
                                            <em class="icon ni ni-sign-kobo"></em>
                                        </div>
                                        <h5 class="nk-wgw-title title">Main Balance</h5>
                                    </div>
                                    <div class="nk-wgw-balance">
                                        <div class="amount">₦{{number_format($user['wallet']['main_balance'], 2)}}</div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-sm-6 col-lg-4 col-xl-6 col-xxl-4">
                        <div class="card card-bordered">
                            <div class="nk-wgw">
                                <div class="nk-wgw-inner">
                                    <div class="nk-wgw-name">
                                        <div class="nk-wgw-icon">
                                            <em class="icon ni ni-sign-kobo"></em>
                                        </div>
                                        <h5 class="nk-wgw-title title">Referral Earnings</h5>
                                    </div>
                                    <div class="nk-wgw-balance d-flex flex-wrap justify-content-between">
                                        <div class="amount">₦{{number_format($user['wallet']['ref_commission'], 2)}}</div>
                                        <x-swal href="{{route('transfer.move', ['wallet' => 'ref_commission'])}}" class="btn fw-bold btn-outline btn-outline-primary btn-xs">Transfer to Main Balance</x-swal>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-sm-6 col-lg-4 col-xl-6 col-xxl-4">
                        <div class="card card-bordered">
                            <div class="nk-wgw">
                                <div class="nk-wgw-inner">
                                    <div class="nk-wgw-name">
                                        <div class="nk-wgw-icon">
                                            <em class="icon ni ni-sign-kobo"></em>
                                        </div>
                                        <h5 class="nk-wgw-title title">Bonus Earnings</h5>
                                    </div>
                                    <div class="nk-wgw-balance d-flex flex-wrap justify-content-between">
                                        <div class="amount">₦{{number_format($user['wallet']['bonus'], 2)}}</div>
                                        <x-swal href="{{route('transfer.move', ['wallet' => 'bonus'])}}" class="btn fw-bold btn-outline btn-outline-primary btn-xs">Transfer to Main Balance</x-swal>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-sm-6 col-lg-4 col-xl-6 col-xxl-4">
                        <div class="card card-bordered">
                            <div class="nk-wgw">
                                <div class="nk-wgw-inner">
                                    <div class="nk-wgw-name">
                                        <div class="nk-wgw-icon">
                                            <em class="icon ni ni-sign-kobo"></em>
                                        </div>
                                        <h5 class="nk-wgw-title title">Cash Back</h5>
                                    </div>
                                    <div class="nk-wgw-balance d-flex flex-wrap justify-content-between">
                                        <div class="amount">₦{{number_format($user['wallet']['cash_back'], 2)}}</div>
                                        <x-swal href="{{route('transfer.move', ['wallet' => 'cash_back'])}}" class="btn fw-bold btn-outline btn-outline-primary btn-xs">Transfer to Main Balance</x-swal>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-sm-6 col-lg-4 col-xl-6 col-xxl-4">
                        <div class="card card-bordered">
                            <div class="nk-wgw">
                                <div class="nk-wgw-inner">
                                    <div class="nk-wgw-name">
                                        <div class="nk-wgw-icon">
                                            <em class="icon ni ni-arrow-up-right"></em>
                                        </div>
                                        <h5 class="nk-wgw-title title">Accumulated Points</h5>
                                    </div>
                                    <div class="nk-wgw-balance d-flex flex-wrap justify-content-between">
                                        <div class="amount">{{number_format($user['wallet']['points'])}} PV</div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card -->
                    </div><!-- .col -->
                    <div class="col-sm-6 col-lg-4 col-xl-6 col-xxl-4">
                        <div class="card card-bordered">
                            <div class="nk-wgw">
                                <div class="nk-wgw-inner">
                                    <div class="nk-wgw-name">
                                        <div class="nk-wgw-icon">
                                            <em class="icon ni ni-sign-kobo"></em>
                                        </div>
                                        <h5 class="nk-wgw-title title">Total withdrawals</h5>
                                    </div>
                                    <div class="nk-wgw-balance">
                                        <div class="amount">₦{{number_format($user['wallet']['withdrawals'], 2)}}</div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div>


            <div class="nk-block nk-block-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4>Wallet Transactions</h4>
                    </div>
                </div>
                @if($wallet_transactions->isEmpty())
                <div class="card-body">
                    <div class="alert alert-warning">
                        <p style="text-align: center;">
                            There are currently no transactions yet from the account!!!
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
                                    <span class="tb-odr-id">Purpose</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Amount</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Payment Method</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Transaction Type</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Status</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Date</span>
                                </th>
                                <th class="tb-odr-info">Action</th>
                                <th class="tb-odr-info">Delete</th>
                            </tr>
                        </thead>
                        <tbody class="tb-odr-body">
                            @foreach($wallet_transactions as $key=>$item)
                            <tr class="tb-odr-item">
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id">{{ $wallet_transactions->firstItem() + $key }}</span>
                                </td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id" style="font-weight: bold; text-transform:capitalize">{{$item->purpose}}</span>
                                </td>
                                <td class="tb-odr-info">
                                    @if($item->trans_type == config('constants.trans_types.withdraw'))
                                    <span class="tb-odr-id text-danger"> - ₦{{number_format($item->amount, 2)}}</span>
                                    @else
                                    <span class="tb-odr-id text-success">₦{{number_format($item->amount, 2)}}</span>
                                    @endif
                                </td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id">{{$item->payment_method}}</span>
                                </td>
                                <td class="tb-odr-info">
                                    @if($item->trans_type == config('constants.trans_types.withdraw'))
                                    <span class="badge badge-pill badge-danger">{{$item->trans_type}}</span>
                                    @else
                                    <span class="badge badge-pill badge-success">{{$item->trans_type}}</span>
                                    @endif
                                </td>
                                <td class="tb-odr-info">
                                    @if($item->status == "Pending")
                                    <span class="badge badge-pill badge-warning">{{$item->status}}</span>
                                    @elseif($item->status == "Completed")
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
                                        <a href="/transaction/{{$item->id}}" class="btn btn-sm btn-primary">View</a>
                                    </div>
                                </td>
                                <td class="tb-odr-info">
                                    <a style="cursor: pointer;" onclick="showModal('{{ $item->purpose }}', '{{ $item->id }}')">
                                        <div class="nk-wgw-icon bg-danger">
                                            <em class="icon ni ni-trash"></em>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- .card-preview -->
                <div class="row d-flex justify-content-center" style="margin-top: 1rem;">
                    {!! $wallet_transactions->appends(['wallet_transactions'=>$wallet_transactions->currentPage()])->links() !!}
                </div>
                @endif
            </div><!-- nk-block -->

        </div>
    </div>

    @include('modals.transfer')
@stop
