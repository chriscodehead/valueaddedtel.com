<?php
    $title = 'Transfers';
?>

@extends('layout')

@section('contents')
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                        <h2 class="nk-block-title fw-normal">Transfers</h2>
                    </div>
                </div>
            </div>
            <div class="nk-block">
                <div class="card card-bordered card-preview table-responsive">
                    <table class="table table-orders">
                        <thead class="tb-odr-head">
                            <tr class="tb-odr-item">
                                <th>S/N</th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Sender</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Reciever</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Amount</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Date Completed</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="tb-odr-body">
                            @forelse($transfers as $key => $transfer)                              
                                <tr class="tb-odr-item">
                                    <td >{{ ++$key }}</td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id" style="font-weight: bold;">{{$transfer->sender->fullname}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id" style="font-weight: bold;">{{$transfer->reciever->fullname}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id" style="font-weight: bold;">N {{number_format($transfer->amount)}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id" style="font-weight: bold;">{{ Date::parse($transfer->created_at)->format('jS F Y') }}</span>
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>

                    {{$transfers->links()}}
                </div>
            </div>
        </div>
    </div>
@stop