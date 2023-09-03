<?php
$title = 'VTU History';
?>

@extends('layout')
@section('contents')



<div class="nk-content-body">
    <div class="nk-block nk-block-lg" style="margin-top: 3rem;">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4>VTU Transaction History</h4>
            </div>
        </div>
        @if($histories->isEmpty())
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
                            <span class="tb-odr-id">Service</span>
                        </th>
                        <th class="tb-odr-info">
                            <span class="tb-odr-id">Amount</span>
                        </th>
                        <th class="tb-odr-info">
                            <span class="tb-odr-id">Phone</span>
                        </th>
                        <th class="tb-odr-info">
                            <span class="tb-odr-id">Plan</span>
                        </th>
                        <th class="tb-odr-info">
                            <span class="tb-odr-id">Network</span>
                        </th>
                        <th class="tb-odr-info">
                            <span class="tb-odr-id">Date</span>
                        </th>
                        <th class="tb-odr-info">Action</th>
                        <th class="tb-odr-info">Delete</th>
                    </tr>
                </thead>
                <tbody class="tb-odr-body">
                    @foreach($histories as $key=>$item)
                    <tr class="tb-odr-item">
                        <td class="tb-odr-info">
                            <span class="tb-odr-id">{{ $histories->firstItem() + $key }}</span>
                        </td>
                        <td class="tb-odr-info">
                            <span class="tb-odr-id text-capitalize"><?php echo implode(' ', explode('_', $item->service)) ?></span>
                        </td>
                        <td class="tb-odr-info">
                            <span class="tb-odr-id">₦{{number_format($item->amount, 2)}}</span>
                        </td>
                        <td class="tb-odr-info">
                            <span class="tb-odr-id">{{$item->phone}}</span>
                        </td>
                        <td class="tb-odr-info">
                            @if($item->vtu_plan)
                            <span class="tb-odr-id">{{Str::limit($item->vtu_plan, 15, '...')}}</span>
                            @else
                            <span class="tb-odr-id">N/A</span>
                            @endif
                        </td>
                        <td class="tb-odr-info">
                            @if($item->network)
                            <span class="tb-odr-id">{{$item->network}}</span>
                            @else
                            <span class="tb-odr-id">N/A</span>
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
                        <td class="tb-odr-info">
                            <a style="cursor: pointer;" onclick="showDeleteHistoryModal('{{ $item->id }}')">
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
            {!! $histories->appends(['histories'=>$histories->currentPage()])->links() !!}
        </div>
        @endif
    </div><!-- nk-block -->
</div>


@stop