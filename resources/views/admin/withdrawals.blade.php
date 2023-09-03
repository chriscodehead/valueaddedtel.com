<?php
$title = 'Withdrawals';
?>

@extends('layout')
@section('contents')

    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                        <h2 class="nk-block-title fw-normal">Withdrawals</h2>
                    </div>
                </div>
            </div>

            <div class="nk-block nk-block-lg" >
        <div class="nk-block-head">
            <div class="nk-block-head-content">
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
                            <span class="tb-odr-id">Reference</span>
                        </th>
                      	<th class="tb-odr-info">
                            <span class="tb-odr-id">User</span>
                        </th>
                        <th class="tb-odr-info">
                            <span class="tb-odr-id">Amount</span>
                        </th>
                        <th class="tb-odr-info">
                            <span class="tb-odr-id">Bank Information</span>
                        </th>
                        <th class="tb-odr-info">
                            <span class="tb-odr-id">Wallet Balance</span>
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
                            <span class="tb-odr-id" style="font-weight: bold; text-transform:capitalize">{{$item->reference}}</span>
                        </td>
                        <td class="tb-odr-info">
                            <span class="tb-odr-id" style="font-weight: bold; text-transform:capitalize">{{$item->user?->full_name}}</span>
                        </td>
                        <td class="tb-odr-info">
                            @if($item->trans_type == config('constants.trans_types.withdraw'))
                                <span class="tb-odr-id text-danger"> - @if($item->purpose !== 'PV') ₦ @endif  {{number_format($item->amount, 2)}}</span>
                            @else
                                <span class="tb-odr-id text-success">@if($item->purpose !== 'PV') ₦ @endif {{number_format($item->amount, 2)}}</span>
                            @endif
                        </td>
                        <td class="tb-odr-info">
                          	<span class="tb-odr-id">{{$item->account_name}}</span> <br/>
                            <span class="tb-odr-id">{{$item->bank_name}}</span>
                          	<br/>
                          	<span class="tb-odr-id">{{$item->account_no}}</span>
                        </td>
                      	<td class="tb-odr-info">
                            <span class="tb-odr-id"><x-naira/>{{number_format($item->user?->wallet->main_balance)}}</span>
                        </td>
                        <td class="tb-odr-info">
                            @if($item->status == "Pending")
                            <span class="badge badge-pill badge-warning">{{$item->status}}</span>
                            @elseif($item->status == "Completed")
                            <span class="badge badge-pill badge-success">{{$item->status}}</span>
                            @elseif($item->status == 'Declined')
                            <span class="badge badge-pill badge-danger">{{$item->status}}</span>
                          	@else
	                          <span class="badge badge-pill badge-primary">{{$item->status}}</span>
                            @endif
                        </td>
                        <td class="tb-odr-info">
                            <span class="tb-odr-id">{{\Carbon\Carbon::parse($item->created_at)->diffForHumans()}}</span>
                        </td>
                        <td class="tb-odr-info">
                            <div class="tb-odr-btns d-md-inline">
                                <a href="/transaction/{{$item->transaction_id}}" class="btn btn-sm btn-primary">View</a>
                            </div>
                          @if(auth()->user()->is_super_admin)
                          @if($item->status == config('constants.statuses.pending'))
                            <a href="#" class="dropdown-toggle btn btn-sm btn-success" data-toggle="dropdown">Approve</a>
                            <div class="dropdown-menu dropdown-menu-right">
                              <ul class="link-list-plain">
                                @if (\App\Models\Settings::first()->enable_paystack)  
                                <li><x-swal href="{{route('admin.withdrawal.approve', ['withdrawal' => $item->id, 'method' => 'paystack'])}}">Pay with Paystack</x-swal></li>
                                @endif
                                <li><x-swal id="" href="{{route('admin.withdrawal.approve', ['withdrawal' => $item->id, 'method' => 'manual'])}}"  >Manual Payment</x-swal></li>
                              </ul>
                            </div>
                          
                          	<a class="btn btn-sm btn-danger" href="#" data-toggle="modal" data-target="#withdrawal-{{$item->id}}">Decline</a>
                          
                          	<x-modal id="withdrawal-{{$item->id}}">
                              <h5>Decline Transaction</h5>
                              <p>Please provide a reason for the transaction decline.</p>
                              <form x-data="{reason: '', }" action="{{route('admin.withdrawal.decline', ['withdrawal' => $item->id])}}" method="post">
                                @csrf
                                
                                <div class="form-check">
                                  <input class="form-check-input" name="status" id="funds" x-on:change="reason = 'You do not have sufficient funds for this transaction.'" type="radio" >
                                  <label class="form-check-label" for="funds">
                                    Insufficient Funds
                                  </label>
                                </div>
                                
                                <div class="form-check">
                                  <input class="form-check-input" name="status" id="info" x-on:change="reason = 'You have not completed the required information on your profile.'" type="radio" >
                                  <label class="form-check-label" for="info">
                                    Incomplete Information
                                  </label>
                                </div>
                                
                                <div class="form-check">
                                  <input class="form-check-input" name="status" id="suspicion" x-on:change="reason = 'We have detected some suspicious activity on your account. Please contact support to rectify.'" type="radio" >
                                  <label class="form-check-label" for="suspicion">
                                    Suspicious Activity
                                  </label>
                                </div>
                                
                                <div class="form-check">
                                  <input class="form-check-input" name="status" id="other" type="radio"  x-on:change="reason = ''" name="flexRadioDefault" >
                                  <label class="form-check-label" for="other">
                                    Other Reason
                                  </label>
                                </div>
                                

                                <div class="form-group">
                                  <label class="form-label" >Reason</label>
                                	<textarea name="reason" class="form-textarea form-control" x-text="reason" x-on:change="reason = $event.target.value" ></textarea>
                                </div>
                                
                                <div class="form-group">
                                  <label class="form-label" >Refund Withdrawal Amount</label>
                                  <br/>
                                	<select name="refund" class="form-select form-control" >
                                      <option value="">Select Option</option>
                                  		<option value="yes">Yes</option>
                                      	<option value="no" @selected(true)>No</option>
                                  	</select>
                                </div>
                                
                                <button class="btn btn-primary">Submit</button>
                              </form>
                          	</x-modal>
                          @endif
                          @endif
                        </td>
                        <td class="tb-odr-info">
                            <x-swal style="cursor: pointer;" href="{{route('admin.withdrawal.delete', ['withdrawal' => $item->id])}}">
                                <div class="nk-wgw-icon bg-danger">
                                    <em class="icon ni ni-trash"></em>
                                </div>
                            </x-swal>
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