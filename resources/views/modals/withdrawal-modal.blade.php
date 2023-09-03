<!-- Modal Form -->
<div class="modal fade" tabindex="-1" id="withdrawalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Withdraw Funds</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <x-form-swal warning="Proceed with funds withdrawal?" id="withdrawal-form-awesome" action="{{route('withdrawl.initiate')}}"  method="POST" class="form-validate is-alter">
                    @csrf

                    
                    @if ($user->bank_code && $user->bank_name && $user->account_name && $user->account_number)
                        <div class="mb-3">
                            <h6>Your Bank Information</h6>
                            <div >
                                <p class="fs-16px mb-0 fw-medium">Bank Name: <span class="fw-normal">{{$user->bank_name}}</span></p>
                                <p class="fs-16px mb-0 fw-medium">Account Number: <span class="fw-normal">{{$user->account_number}}</span></p>
                                <p class="fs-16px mb-0 fw-medium">Account Name: <span class="fw-normal">{{$user->account_name}}</span></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="amount">Enter amount</label>
                                    <div class="form-control-wrap">
                                        <input type="number" class="form-control form-control-lg" id="amount" name="amount" placeholder="Enter Amount" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="pin">Enter Your Pin</label>
                                    <div class="form-control-wrap">
                                        <input type="password" class="form-control form-control-lg" maxlength="4" id="pin" name="pin" placeholder="****" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-lg btn-primary">Proceed</button>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Please proceed to your Account profile to set up your bank account information to enable withdrawal on your wallet!.
                            <br>
                            <a href="{{route('profile')}}">My Account</a>
                        </div>
                        
                    @endif
                </x-form-swal>
            </div>
        </div>
    </div>
</div>