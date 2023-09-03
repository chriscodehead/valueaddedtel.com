<x-user-layout :user="$user" :selectedUser="$selectedUser" >
<div class="nk-block nk-block-lg" >
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <a href="{{route('admin.users.referrals', ['user' => $selectedUser->username])}}"><em class="ni ni-back-alt"></em> Back to Referrals</a>
                    <h4> <span>{{$referrer->full_name}}</span> - Downlines</h4>
                </div>
            </div>

            @if($referrals->isEmpty())
                <div class="card-body">
                    <div class="alert alert-warning">
                        <p style="text-align: center;">
                            There are not downlines for this user
                        </p>
                    </div>
                </div>
            @else
            
            <div class="card card-bordered card-preview table-responsive">
                <table class="table table-orders">
                    <thead class="tb-odr-head">
                       
                        <tr class="tb-odr-item">
                            <th >
                                S/N
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Fullname</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Email Address</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Phone Number</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Current Plan</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Downline Level</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Referred By</span>
                            </th>
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Date Joined</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="tb-odr-body">
                        @foreach($referrals as $key => $item)
                            <?php
                                // $refBy = User::where('my_ref_code', $item->refer_by)->first();
                                $position = $item->getPositionOnDownline($selectedUser);
                            ?> 
                        <tr class="tb-odr-item">
                            <td >{{ $key+1 }}</td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{$item->full_name}}</span>
                            </td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{$item->email}}</span>
                            </td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{$item->phone}}</span>
                            </td>
                            
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{$item->plan->package_name}}</span>
                            </td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{position($position)}} Level</span>
                            </td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{$item->referrer->fullname}}</span>
                            </td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{ Date::parse($item->created_at)->format('jS F Y') }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- .card-preview -->
            @endif
        </div><!--
</x-user-layout>