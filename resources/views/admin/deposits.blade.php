<?php
$title = 'Deposits';
?>

@extends('layout')
@section('contents')

    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                        <h2 class="nk-block-title fw-normal">Deposits</h2>
                    </div>
                </div>
            </div>

            <div class="nk-block nk-block-lg" >
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4>Deposit History</h4>
            </div>
        </div>
        @if($transactions->isEmpty())
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
                            <span class="tb-odr-id">User</span>
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
                    @foreach($transactions as $key=>$item)
                    <tr class="tb-odr-item">
                        <td class="tb-odr-info">
                            <span class="tb-odr-id">{{ $transactions->firstItem() + $key }}</span>
                        </td>
                      <td class="tb-odr-info">
                            <span class="tb-odr-id" style="font-weight: bold; text-transform:capitalize">{{$item->user->full_name}}</span>
                        </td>
                        <td class="tb-odr-info">
                            <span class="tb-odr-id" style="font-weight: bold; text-transform:capitalize">{{$item->purpose}}</span>
                        </td>
                        <td class="tb-odr-info">
                            @if($item->trans_type == config('constants.trans_types.withdraw'))
                                <span class="tb-odr-id text-danger"> - @if($item->purpose !== 'PV') ₦ @endif  {{number_format($item->amount, 2)}}</span>
                            @else
                                <span class="tb-odr-id text-success">@if($item->purpose !== 'PV') ₦ @endif {{number_format($item->amount, 2)}}</span>
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
            {!! $transactions->appends(['transactions'=>$transactions->currentPage()])->links() !!}
        </div>
        @endif
    </div>
        </div>
    </div>

@stop