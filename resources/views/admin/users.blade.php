<?php
    $title = 'Users';
?>

@extends('layout')

@section('contents')
    <div class="container-xl wide-lg">
        <div class="nk-content-body">
            <div class="nk-block-head">
                <div class="nk-block-between-md g-4">
                    <div class="nk-block-head-content">
                      	@if(request()->input('sort'))
	                      <h2 class="nk-block-title fw-normal">Top Users</h2>                      	
                      	@else
	                      <h2 class="nk-block-title fw-normal">Users</h2>
                      	@endif
                    </div>
                  <div>
                    <form action="{{route('admin.users')}}" >
                          <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><em class="ni ni-search" ></em></span>
                            <input type="text" class="form-control" name="keyword" placeholder="Search Name or Username" aria-label="Username" aria-describedby="basic-addon1">
                          </div>
                      
                      		@if(request()->input('sort'))
                      			<input type="text" class="form-control" name="sort" value="pv" hidden placeholder="Search Name or Username" aria-label="Username" aria-describedby="basic-addon1">
                      		@endif
                    </form>
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
                                    <span class="tb-odr-id">Fullname</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Email Address</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Monthly PV</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Current Plan</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Date Joined</span>
                                </th>
                                <th class="tb-odr-info"></th>
                            </tr>
                        </thead>
                        <tbody class="tb-odr-body">
                            @forelse($users as $key => $item)                              
                                <tr class="tb-odr-item">
                                    <td >{{ ++$key }}</td>
                                    <td class="tb-odr-info">
                                        <a href="{{route('admin.users.details', ['user' => $item->username])}}" class="tb-odr-id" style="font-weight: bold;">{{$item->fullname}}</a> 
                                        <br/>
                                        <span class="tb-odr-id" style="font-weight: bold;">{{$item->phone}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id" style="font-weight: bold;">{{$item->email}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id" style="font-weight: bold;">{{$item->wallet->monthly_pv}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id" style="font-weight: bold;">{{$item->plan->package_name}}</span>
                                    </td>
                                    <td class="tb-odr-info">
                                        <span class="tb-odr-id" style="font-weight: bold;">{{ Date::parse($item->created_at)->format('jS F Y') }}</span>
                                    </td>
                                    <td class="">
                                        <a href="{{route('admin.users.details', ['user' => $item->username])}}" class="btn btn-sm btn-primary" >View</a>
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                  
                  {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
@stop