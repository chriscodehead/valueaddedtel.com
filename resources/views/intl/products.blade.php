<?php
$title = 'International Bills';
?>
@extends('layout')
@section('contents')

<div class="container-xl wide-lg">
    <div class="nk-content-body">
        <div class="nk-block-head mb-0 pb-0">
            <div class="nk-block-between-md g-4">
                <div class="nk-block-head-content">
                    <h2 class="nk-block-title fw-normal">International Bills</h2>
                </div>
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <!-- content @s -->
        <div class="nk-content-body pt-0">
            <div class="kyc-app wide-lg m-auto" x-data="{ 
                operators: [], 
                code: '{{$code}}', 
                packages: [],
                selectedService: null, 
                loadingServices: 'Select Package', 
                providerIsLoading: 'Select Service Provider',
                selectedPackage: null,
                amount: ''
            }">
                <div class="nk-block">
                    </div>
                    
                    <div class="nk-block mt-5">
                        @include('components.upgrade-account')
    
                        <div class="card card-bordered">
                            <div class="nk-kycfm">
                                <div class="nk-kycfm-content">
                                    <x-form-swal warning="Proceed with this purchase?" id="intl-bills-form" action="{{route('intl-bills.pay', [
                                        'country_code' => $code])}}" method="POST">
                                        @csrf

                                        <div class="row g-4 d-flex justify-content-center">                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-label-group">
                                                        <label class="form-label">Select Service</label>
                                                    </div>
                                                    <select name="service" 
                                                            x-on:change="
                                                            providerIsLoading = 'Loading...';
                                                            fetch(`/intl-bills/${code}/${$event.target.value}`,{
                                                                method: 'GET',
                                                                headers: {
                                                                    Accept: 'application/json',
                                                                    'Content-Type': 'application/json'
                                                                }
                                                            })
                                                            .then(async (res) => {
                                                                const data = await res.json()
                                                                if(!res.ok) {
                                                                    loadingServices = 'Select Package';
                                                                    return Swal.fire(data.error, '', 'error')
                                                                }
                                                                operators = data
                                                                providerIsLoading = 'Select Service Provider';
                                                                selectedService = $event.target.value;
                                                            })"
                                                        class="form-control form-control-lg" 
                                                        required
                                                        >
                                                        <option value="" >Select a Service</option>
                                                        @forelse ($products as $product)
                                                            <option value="{{$product['product_type_id']}}"  >{{$product['name']}}</option>
                                                        @empty
                                                        @endforelse
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Service Provider</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <select name="provider" 
                                                    x-on:change="
                                                            loadingServices = 'Loading...';
                                                            fetch(`/intl-bills/services/${code}/${selectedService}/${$event.target.value}`, {
                                                                method: 'GET',
                                                                headers: {
                                                                    Accept: 'application/json',
                                                                    'Content-Type': 'application/json'
                                                                }
                                                            }).then(async (res) => {
                                                                const data = await res.json()
                                                                if(!res.ok) {
                                                                    loadingServices = 'Select Package';
                                                                    return Swal.fire(data.error, '', 'error')
                                                                }
                                                                packages = data
                                                                loadingServices = 'Select Package';
                                                        })"
                                                        class="form-control form-control-lg" 
                                                        required
                                                        >
                                                        <option value="" x-text='providerIsLoading'></option>
                                                        <template x-for="operator in operators" :key="operator.operator_id">
                                                            <option :value="operator.operator_id"   x-text="operator.name" ></option>
                                                        </template>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Package Plan</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <select name="plan" x-on:change="
                                                        selectedPackage = packages.variations.find(val => val.variation_code == $event.target.value)
                                                        amount = packages.variations.find(val => val.variation_code == $event.target.value).variation_amount
                                                    " class="form-control form-control-lg" id="type" required>
                                                        <option value="" x-text='loadingServices'></option>
                                                        <template x-for="package in packages.variations" :key="package.variation_code">
                                                            <option :value="package.variation_code"   x-text="package.name" ></option>
                                                        </template>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-label-group d-flex justify-content-between">
                                                    <label class="form-label">Amount</label>

                                                    <span class="text-danger" x-show="!!selectedPackage && !!!selectedPackage?.variation_amount">
                                                        <span x-if="!!selectedPackage?.variation_amount_min" x-text="'Min ' + selectedPackage?.variation_amount_min"></span>
                                                        <span x-if="selectedPackage?.variation_amount_min && selectedPackage?.variation_amount_max" >-</span>
                                                        <span x-if="!!selectedPackage?.variation_amount_max" x-text="'Max ' +selectedPackage?.variation_amount_max"></span>
                                                    </span>
                                                </div>
                                                <div class="form-control-group">
                                                    <input type="number" id="amount" :value="amount" name="amount" :readonly="!!amount" class="form-control form-control-lg" placeholder="Enter Amount" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-label-group d-flex justify-content-between">
                                                    <label class="form-label">Recipient Phone Number</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <input type="tel" name="phone"  class="form-control form-control-lg" placeholder="Recipient Phone Number" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Select Payment Method</label>
                                                <div class="form-control-wrap">
                                                    <select class="form-control form-control-lg" name="payment_method" required>
                                                        <option value="">Select Here</option>
                                                        <option value="wallet" default>Wallet - NGN{{number_format($user['wallet']['main_balance'], 2)}}</option>
                                                        @if (\App\Models\Settings::first()->enable_paystack)                                                        
                                                            <option value="paystack">Paystack</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-label-group">
                                                    <label class="form-label">Enter Transaction PIN</label>
                                                </div>
                                                <div class="form-control-group">
                                                    <input type="password" minlength="4" maxlength="4" pattern="[0-9]{4}" id="pin" class="form-control form-control-lg" placeholder="Enter PIN here" name="pin" required>
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                        <div class="col-lg-12">
                                            <div class="row d-flex justify-content-center">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-lg btn-primary" id="submit-btn">Make Payment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .row -->
                                </x-form-swal>
                            </div><!-- .nk-kycfm-content -->
                        </div><!-- .nk-kycfm -->
                    </div>
                </div>
            </div><!-- kyc-app -->
        </div>
        <!-- content @e -->
    </div>
</div>

@stop