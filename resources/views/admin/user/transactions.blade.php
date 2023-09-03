<x-user-layout :user="$user" :selectedUser="$selectedUser" >
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
            <div class="card card-bordered card-preview">
                <div class="table-responsive">
                    <table class="table table-orders">
                        <thead class="tb-odr-head">
                            <tr class="tb-odr-item">
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Type</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Amount</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Payment Method</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Status</span>
                                </th>
                                <th class="tb-odr-info">
                                    <span class="tb-odr-id">Date</span>
                                </th>
                                <th class="tb-odr-info">Action</th>
                            </tr>
                        </thead>
                        <tbody class="tb-odr-body">
                            @foreach($transactions as $key=>$item)
                            <tr class="tb-odr-item">
                                <td class="tb-odr-info">
                                    @if($item->trans_type == config('constants.trans_types.withdraw'))
                                    <span class="badge badge-pill badge-danger">{{$item->trans_type}}</span>
                                    @else
                                    <span class="badge badge-pill badge-success">{{$item->trans_type}}</span>
                                    @endif
                                </td>
                                <td class="tb-odr-info">
                                    @if($item->trans_type == config('constants.trans_types.withdraw'))
                                        <span class="tb-odr-id text-danger"> - @if($item->purpose !== 'PV') ₦ @endif  {{number_format($item->amount, 2)}}</span>
                                    @else
                                        <span class="tb-odr-id text-success">@if($item->purpose !== 'PV') ₦ @endif {{number_format($item->amount, 2)}}</span>
                                    @endif
                                </td>
                                <td class="tb-odr-info">
                                    <span class="tb-odr-id">{{$item->payment_method}}</span>
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
                                    <a href="/transaction/{{$item->id}}" class="btn btn-sm btn-primary">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- .card-preview -->
            <div class="row d-flex justify-content-center" style="margin-top: 1rem;">
                {!! $transactions->appends(['transactions'=>$transactions->currentPage()])->links() !!}
            </div>
        @endif
    </div>
</x-user-layout>