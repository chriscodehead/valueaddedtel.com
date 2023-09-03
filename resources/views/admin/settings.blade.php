<?php
$title = 'Settings';
?>

@extends('layout')
@section('contents')
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                        <h2 class="nk-block-title fw-normal">App Settings</h2>
                    </div>
                </div>
            </div>
            <div class="nk-block ">
                <div class="card border">
                    <div class="card-body">
                        <h4 class="card-title">Settings</h4>
                        <form action="{{route('admin.settings.update')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Monnify Charge</label>
                                        <input type="text" name="monnify_charge" value="{{$settings->monnify_charge}}" class="form-control" id="">
                                        <x-error key="monnify_charge" />
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Enable Paystack</label>
                                        <select name="enable_paystack" class="form-select" id="">
                                            <option value="yes" @selected(!!$settings->enable_paystack)>Yes</option>
                                            <option value="no" @selected(!!!$settings->enable_paystack)>No</option>
                                        </select>
                                        <x-error key="enable_paystack" />
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Withdrawal Threshold</label>
                                        <input type="number" class="form-control" name="withdrawal_threshold" value="{{$settings->withdrawal_threshold}}">
                                        <x-error key="withdrawal_threshold" />
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <h5>Manual Payment Setting</h5>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Account Name</label>
                                            <input type="text" name="account_name" value="{{$settings->account_name}}" class="form-control" id="">
                                            <x-error key="account_name" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Account Number</label>
                                            <input type="text" name="account_no" value="{{$settings->account_no}}" class="form-control" id="">
                                            <x-error key="account_no" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Bank Name</label>
                                            <input type="text" name="bank_name" value="{{$settings->bank_name}}" class="form-control" id="">
                                            <x-error key="bank_name" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3" >
                                <h5>Contact Information</h5>
    
                                <div class="row g-4">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Telegram Link</label>
                                            <input type="text" name="telegram_link" value="{{$settings->telegram_link}}" class="form-control" id="">
                                            <x-error key="telegram_link" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" name="phone_number" value="{{$settings->phone_number}}" class="form-control" id="">
                                            <x-error key="phone_number" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Whatsapp Number</label>
                                            <input type="text" name="whatsapp_number" value="{{$settings->whatsapp_number}}" class="form-control" id="">
                                            <x-error key="whatsapp_number" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Facebook Number</label>
                                            <input type="text" name="facebook_link" value="{{$settings->facebook_link}}" class="form-control" id="">
                                            <x-error key="facebook_link" />
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="mt-3">
                                <button class="btn btn-primary" type="submit">Update Settings</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card border">
                    <div class="card-body">
                        <h5>Cashback and Charges</h5>
                        <form action="{{route('admin.generalSettings.update')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    @forelse ($generalSettings as $setting)
                                        <div class="row row-cols-2 g-4">
                                            <div class="form-group">
                                                <label class="form-label">{{str($setting->title)->headline()}}</label>
                                                <input type="text" name="{{$setting->title}}" value="{{$setting->value}}" class="form-control" id="">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Type</label>
                                                <select class="form-select" name="type_{{$setting->title}}">
                                                    <option value="percent" @selected($setting->type == 'percent')>Percentage</option>
                                                    <option value="fixed" @selected($setting->type == 'fixed')>Fixed</option>
                                                </select>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            </div>

                            <div class="mt-3">
                                <button class="btn btn-primary" type="submit">Update Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
