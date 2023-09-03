<?php
$title = 'VTU History';
?>


@extends('layout')

@section('contents')
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                        <h2 class="nk-block-title fw-normal">VTU History</h2>
                    </div>
                </div>
            </div>
            <div class="nk-block">
            @if($vtu_histories->isEmpty())
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <p style="text-align: center;">
                                There are currently no transactions yet from the account!!!
                            </p>
                        </div>
                    </div>
                    @else
                    <div class="card card-bordered card-preview table-responsive">
                        <table id="myTable2" class="table table-orders">
                            <thead class="tb-odr-head">
                                <tr class="tb-odr-item">
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">S/N</span>
                                    </th>
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">User</span>
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
                                        <span class="tb-odr-id">{{$item->user->full_name}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id">₦{{number_format($item->amount, 2)}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id" style="text-transform: capitalize;">{{$item->payment_method}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id" style="text-transform: uppercase;">{{$item->network ?? str($item->service)->headline()}}</span>
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
            </div>
        </div>
    </div>
@stop
