<!-- Modal Form -->
<div class="modal fade" tabindex="-1" id="transferForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Transfer</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <x-form-swal warning="Proceed with fund transfer?" id="funds-transfer-form" action="{{route('transfer.initiate')}}" method="POST" class="form-validate is-alter">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="amount">Enter amount</label>
                        <div class="form-control-wrap">
                            <input type="number" class="form-control form-control-lg" id="amount" name="amount" placeholder="Enter Amount" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Recipient Username</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-lg" name="username" placeholder="Enter Reciever's Username" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label">Enter Transaction PIN</label>
                        </div>
                        <div class="form-control-group">
                            <input type="password" minlength="4" maxlength="4" pattern="[0-9]{4}" id="pin" class="form-control form-control-lg" placeholder="Enter PIN here" name="pin" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">Proceed</button>
                    </div>
                </x-form-swal>
            </div>
        </div>
    </div>
</div>
