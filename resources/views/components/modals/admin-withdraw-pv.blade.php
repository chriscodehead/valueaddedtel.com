<x-modal id="withdraw-pv-modal" >
    <h5>Withdraw PVs from User Account</h5>
    <p>PV Balance: <x-naira /> {{number_format($selectedUser->wallet->points)}}</p>

    <form action="{{route('admin.user.withdraw-pv', ['user' => $selectedUser->id])}}" method="post">
        @csrf
        <div id="amount-input-1 text-start" >
            <div class="form-group" >
                <label class="form-label" for="full-name">Enter amount</label>
                <div class="form-control-wrap">
                    <input type="number" placeholder="0" class="form-control form-control-lg" name="amount" required>
                    <x-error key="amount" />
                </div>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary">Withdraw</button>
            </div> 
        </div>
    </form>
</x-modal>