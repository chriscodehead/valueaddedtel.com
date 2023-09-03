<?php
    $title = 'Recharge Pins';
?>

@extends('layout')
@section('contents')

<div class="container-xl wide-lg">
    <div class="nk-content-body">
        <div class="nk-block-head">
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">Recharge Pins</h2>
                </div>
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <!-- content @s -->
        <div class="nk-content-body" x-data="{
                }">
            <div class="kyc-app wide-lg m-auto">
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-body">
                        <table class="table table-orders">
                            <thead class="tb-odr-head">
                                <tr class="tb-odr-item">
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">Mobile Network</span>
                                    </th>
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">Batch Number</span>
                                    </th>
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">Serial Number</span>
                                    </th>
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">Recharge Pin</span>
                                    </th>
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">Amount</span>
                                    </th>
                                    <th class="tb-odr-info">
                                        <span class="tb-odr-id">Date</span>
                                    </th>
                                  	<th class="tb-odr-info"></th>
                                </tr>
                            </thead>
                            <tbody class="tb-odr-body">
                                @forelse ($rechargeCard->data as $data)                           
                                    <tr class="tb-odr-item" x-data="{
                                        copy : 'Copy'
                                    }">
                                        <td class="tb-odr-info">
                                            <span class="tb-odr-id" style="font-weight: bold;">{{$data['mobilenetwork']}}</span>
                                        </td>
                                        <td class="tb-odr-info">
                                            <span class="tb-odr-id" style="font-weight: bold;">{{$data['batchno']}}</span>
                                        </td>
                                        <td class="tb-odr-info">
                                            <span class="tb-odr-id" style="font-weight: bold;">{{$data['sno']}}</span>
                                        </td>
                                        <td class="tb-odr-info">
                                            <span class="tb-odr-id" style="font-weight: bold;">{{$data['pin']}} <button x-on:click="copy = 'Copied'; setTimeout(() => copy = 'Copy', 1000);window.navigator.clipboard.writeText('{{$data['pin']}}')" class="btn btn-sm btn-primary btn-dim" x-text="copy"></button> </span>
                                        </td>
                                        <td class="tb-odr-info">
                                            <span class="tb-odr-id" style="font-weight: bold;">N {{number_format($data['amount'])}}</span>
                                        </td>
                                        <td class="tb-odr-info">
                                            <span class="tb-odr-id" style="font-weight: bold;">{{Date::parse($data['transactiondate'])->format('jS F, Y')}}</span>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                        </div>
                    </div><!-- .card -->
                </div><!-- nk-block -->
            </div><!-- kyc-app -->
        </div>
        <!-- content @e -->
    </div>
</div>
@stop