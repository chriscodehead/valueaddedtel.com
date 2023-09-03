<x-modal id="deposit-modal" >                                
    <h5>Deposit to User Account</h5>
    <p>Wallet Balance: <x-naira /> {{number_format($selectedUser->wallet->main_balance)}}</p>
    
    <form action="{{route('admin.user.deposit', ['user' => $selectedUser->id])}}" method="post">
        @csrf
        <div id="amount-input-1 text-start" >
            <div class="form-group" >
                <label class="form-label" for="full-name">Enter amount</label>
                <div class="form-control-wrap">
                    <input type="number" placeholder="0" class="form-control form-control-lg" id="full-name" name="amount" required>
                    <x-error key="amount" />
                </div>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary">Deposit</button>
            </div> 
        </div>
    </form>
</x-modal>