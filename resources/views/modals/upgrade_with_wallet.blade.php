<?php

use App\Models\PackagePlan;

$plan = PackagePlan::find('item-id');
?>
<div class="modal fade" id="payWithWallet" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Pay with wallet</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Are you sure you want to pay for plan upgrade with wallet?</h4>
                <br>
                <p style="font-size: 15px; font-weight:bold; text-align:right"> Wallet Balance: ₦{{number_format($user['wallet']['main_balance'], 2)}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <form action="{{route('purchase-plan-wallet')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="item-id">
                    <button type="submit" class="btn btn-primary">Yes, Proceed</button>
                </form>
            </div>
        </div>
    </div>
</div>