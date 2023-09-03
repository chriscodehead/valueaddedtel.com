<?php
$title = 'Dashboard';
?>

@extends('layout')
@section('contents')



<div class="nk-content-body">
    <div class="nk-block-head">
        <div class="nk-block-head-sub"><span>Welcome!</span>
        </div>
        <div class="nk-block-between-md align-items-start g-4">
            <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">{{$user['fullname']}}</h2>
                <div class="nk-block-des">
                    <p>At a glance summary of your account. Have fun!</p>
                </div>
            </div>
            <div>
                <button type="button" data-toggle="modal" data-target="#modalForm" class="btn btn-primary btn-lg">Fund Account</button>
            </div>
        </div>
    </div>

    @include('components.upgrade-account')


    <div class="d-block d-md-none">
        @if ($user->has('bankAccount'))
            <ul class="nav nav-tabs">
                @foreach ( $user->bankAccount as $key => $bankAccount )
                    <li class="nav-item">
                        <a class="nav-link {{$key == 0 ? 'active' : ''}}" data-toggle="tab" href="#tabItem-{{$bankAccount->bankCode}}-db"><span>{{$bankAccount->bankName}}</span></a>
                    </li>
                @endforeach 
            </ul>
            <div class="tab-content">
                <div class="alert alert-info mb-2">You will be charged <span class="fw-bold">&#8358;{{$settings->monnify_charge}}</span> for every transfer made to these accounts.</div>
                
                @foreach ( $user->bankAccount as $key => $bankAccount )
                    <div class="tab-pane {{$key == 0 ? 'active' : ''}}" id="tabItem-{{$bankAccount->bankCode}}-db">
                        <div class="mb-3 p-2 border rounded">
                            <div class="mb-2">
                                <p class="mb-0">Account Number</p>
                                <p class="mb-0 fs-22px">
                                    {{$bankAccount->accountNumber}} 
                                </p>
                                <p class="mb-0 fs-16px mt-0">{{$bankAccount->bankName}}</p>
                                <p class="mb-0 mt-0">{{$bankAccount->accountName}}</p>
                            </div>
                            
                                <button class="clipboard-init btn btn-primary btn-block" id="copy-btn-{{$bankAccount->bankCode}}-db">
                                    <em class="clipboard-icon icon ni ni-copy"></em> 
                                    <span class="clipboard-text" id="copied-txt-{{$bankAccount->bankCode}}-db" >Copy to Clipboard</span>
                                </button>

                                <script>
                                document.getElementById('copy-btn-{{$bankAccount->bankCode}}-db').addEventListener('click',
                                    function (e) {
                                        window.navigator.clipboard.writeText('{{$bankAccount->accountNumber}}')
                                        document.getElementById("copied-txt-{{$bankAccount->bankCode}}-db").innerHTML = 'Copied'
                                        document.getElementById('copy-btn-{{$bankAccount->bankCode}}-db').classList.remove('btn-primary')
                                        document.getElementById('copy-btn-{{$bankAccount->bankCode}}-db').classList.add('btn-success')
                                        

                                        setTimeout(() => {
                                            document.getElementById("copied-txt-{{$bankAccount->bankCode}}-db").innerHTML = 'Copy to Clipboard'
                                            document.getElementById('copy-btn-{{$bankAccount->bankCode}}-db').classList.remove('btn-success')
                                            document.getElementById('copy-btn-{{$bankAccount->bankCode}}-db').classList.add('btn-primary')
                                        }, 1000)
                                    }
                                )
                                </script>
                        </div>
                    </div>
                @endforeach 
            </div>
        @endif
    </div>

    
    <div class="nk-block">
        <div class="row gy-gs">
            <div class="col-lg-5 col-xl-4">
                <div class="nk-block">
                    <div class="nk-block-head-xs">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title title">Overview</h5>
                        </div>
                    </div>
                    <div class="nk-block">
                        <div class="card card-bordered text-light is-dark h-100">
                            <div class="card-inner">
                                <div class="nk-wg7">
                                    <div class="d-flex justify-content-between">
                                        <div class="nk-wg7-stats w-100">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="nk-wg7-title">Main balance</div>
                                                <span class="badge badge-light-primary">{{$user['plan']['package_name']}}</span>
                                            </div>
                                            <div class="number-lg amount">₦{{number_format($user['wallet']['main_balance'], 2)}}</div>
                                        </div>
                                        <div class="nk-wg7-stats">
                                        </div>
                                    </div>
                                    <div class="nk-wg7-stats-group">
                                        <div class="nk-wg7-stats w-50">
                                            <div class="nk-wg7-title">Accumulated Points</div>
                                            <div class="number-md">{{number_format($user['wallet']['points'])}} PV</div>
                                        </div>
                                        <div class="nk-wg7-stats w-50">
                                            <div class="nk-wg7-title">Total Transactions</div>
                                            <div class="number-md">{{$transactions->total()}}</div>
                                        </div>
                                    </div>
                                </div><!-- .nk-wg7 -->
                            </div><!-- .card-inner -->
                        </div><!-- .card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
            <div class="col-lg-7 col-xl-8">
                <!-- <div class="mb-3">
                    <div class="card">
                        <img class="h-300px  rounded rounded-4" style="object-fit: cover;" src="{{asset('home-img/group-friends-playing-relaxing-swimming-pool-during-summer-holidays.jpg')}}" alt="">
                    </div>
                </div> -->
                <div class="nk-block">
                    <div class="nk-block-head-xs">
                        <div class="nk-block-between-md g-2">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title title">Our Services</h5>
                            </div>
                        </div>
                    </div><!-- .nk-block-head -->
                    <div class="row g-2">
                        <div class="col-6 col-sm-3">
                            <a class="card border d-block" href="{{route('airtime')}}">
                                <div class="card-body d-flex align-items-center flex-column justify-content-center">
                                    <div class="w-50 mx-auto">
                                        <img src="{{asset('icons/topup.png')}}" class="img-fluid"  alt="">
                                    </div>
                                    <h6 class="mt-3">Buy Airtime</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-sm-3">
                            <a class="card border d-block" href="{{route('buy-data')}}">
                                <div class="card-body d-flex align-items-center flex-column justify-content-center">
                                    <div class="w-50 mx-auto">
                                        <img src="{{asset('icons/data.png')}}" class="img-fluid"  alt="">
                                    </div>
                                    <h6 class="mt-3">Buy Data</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-sm-3">
                            <a class="card border d-block" href="{{route('cable', ['serviceID' => 'dstv'])}}">
                                <div class="card-body d-flex align-items-center flex-column justify-content-center">
                                    <div class="w-50 mx-auto">
                                        <img src="{{asset('icons/television.png')}}" class="img-fluid"  alt="">
                                    </div>
                                    <h6 class="mt-3">Pay Cable TV</h6>
                                </div>
                            </a>
                        </div>
                        <div class="col-6 col-sm-3">
                            <a class="card border d-block" href="{{route('electricity')}}">
                                <div class="card-body d-flex align-items-center flex-column justify-content-center">
                                    <div class="w-50 mx-auto">
                                        <img src="{{asset('icons/light-bulb.png')}}" class="img-fluid"  alt="">
                                    </div>
                                    <h6 class="mt-3">Electricity</h6>
                                </div>
                            </a>
                        </div>
                        <!-- <div class="col-6 col-sm-3">
                            <a class="card border d-block" href="#">
                                <div class="card-body d-flex align-items-center flex-column justify-content-center">
                                    <div class="w-50 mx-auto">
                                        <img src="{{asset('icons/keypad.png')}}" class="img-fluid"  alt="">
                                    </div>
                                    <h6 class="mt-3">Recharge Pins</h6>
                                </div>
                            </a>
                        </div> -->
                    </div><!-- .row -->
                </div>
            </div>
        </div>
    </div>

    <div class="nk-block nk-block-lg" >
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4>Transaction History</h4>
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
                            <span class="tb-odr-id" style="font-weight: bold; text-transform:capitalize">{{$item->purpose}}</span>
                        </td>
                        <td class="tb-odr-info">
                            @if($item->trans_type == config('constants.trans_types.withdraw'))
                                <span class="tb-odr-id text-danger"> - @if($item->purpose !== 'PV')  @endif  {{number_format($item->amount, 2)}}</span>
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
                            <div class="tb-odr-btns d-inline">
                                <a href="/transaction/{{$item->id}}" class="btn btn-sm btn-primary">View</a>
                            </div>
                            <div class="tb-odr-btns d-inline">
                                <a href="{{route('reciept.print', ['id' => $item->id, 'type' => 'transaction'])}}" class="btn btn-sm btn-primary">Download Reciept</a>
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
    </div><!-- nk-block -->
</div>


@stop
