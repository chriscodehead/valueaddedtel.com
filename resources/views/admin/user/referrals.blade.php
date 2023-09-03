<x-user-layout :user="$user" :selectedUser="$selectedUser" >
    <div class="nk-block nk-block-lg" >
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h6>Referral Team</h6>
            </div>
        </div>
        @if($referrals->isEmpty())
            <div class="card-body">
                <div class="alert alert-warning">
                    <p style="text-align: center;">
                        You do not have any referrals yet!!
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
                            <!-- <th class="tb-odr-info">
                                <span class="tb-odr-id">Referral Level</span>
                            </th> -->
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Current Plan</span>
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
                        <tr class="tb-odr-item">
                            <td >{{ $key+1 }}</td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{$item->user->fullname}}</span>
                                <br>
                                @if ($item->user->referrer)
                                    <a href="{{route('admin.users.downlines', [
                                        'user' => $selectedUser->username,
                                        'downline' => $item->user->username
                                        ])}}" class="btn btn-primary btn-dim btn-xs">Team View</a>
                                @endif
                            </td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{$item->user->email}}</span>
                            </td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{$item->user->phone}}</span>
                            </td>

                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{$item->user->plan->package_name}}</span>
                            </td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{$item->user->referrer?->fullname}}</span>
                            </td>
                            <td class="tb-odr-info">
                                <span class="tb-odr-id" style="font-weight: bold;">{{ Date::parse($item->created_at)->format('jS F Y') }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{$referrals->links()}}
            </div>
        @endif
    </div>
</x-user-layout>