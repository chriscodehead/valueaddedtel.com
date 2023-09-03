<?php
$title = 'Packages';
?>

@extends('layout')

@section('contents')
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                        <h2 class="nk-block-title fw-normal">Packages</h2>
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
                                <span class="tb-odr-id">Package Name</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Reg. Fee</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Reg. Amount</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Level Commission</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Point Value</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Action</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="tb-odr-body">
                        @forelse($packages as $key => $package)
                            <tr class="tb-odr-item">
                                <td >{{ ++$key }}</td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id" style="font-weight: bold;">{{$package->package_name}}</span>
                                </td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id" style="font-weight: bold;"><x-naira/> {{number_format($package->reg_fee)}}</span>
                                </td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id" style="font-weight: bold;"><x-naira/> {{number_format($package->reg_bonus)}}</span>
                                </td>
                                <td class="tb-odr-info">
                                    <span>{{$package->level_commission}}</span>
                                </td>
                                <td class="tb-odr-info">{{ $package->point_value }}</td>
                                <td class="tb-odr-info">
                                    <button class="btn btn-primary btn-sm" data-target="#edit-{{$package->id}}" data-toggle="modal">Edit</button>
                                </td>
                            </tr>

                            @include('modals.edit-package-modal', ['id' => "edit-$package->id"])
                        @empty

                        @endforelse
                        </tbody>
                    </table>

                    {{$packages->links()}}
                </div>
            </div>
        </div>
    </div>
@stop
