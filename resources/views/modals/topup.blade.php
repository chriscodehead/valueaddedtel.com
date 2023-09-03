<!-- Modal Form -->
<div class="modal fade" tabindex="-1" id="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Top Up account</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{route('initiate-top-up')}}" method="POST" class="form-validate is-alter">
                    @csrf

                    <script>
                        function handleChange(e){
                            document.getElementById('amount-input-1').style.display = 'none' 
                            document.getElementById('bank-input-1').style.display = 'none' 
                            document.getElementById('manual-input-1').style.display = 'none' 
                            if(e.target.value == 'bank') {
                                document.getElementById('bank-input-1').style.display = 'block' 
                            }else if(e.target.value == 'manual') {
                                document.getElementById('manual-input-1').style.display = 'block' 
                            }else {
                                document.getElementById('amount-input-1').style.display = 'block' 
                            }
                        }
                    </script>

                    <div class="form-group">
                        <label class="form-label">Select Payment Service</label>
                        <div class="form-control-wrap">
                            <select class="form-select" onchange="handleChange(event)" name="pay_service">
                                <!-- <option value="flw" default>Flutterwave</option> -->
                                @if (\App\Models\Settings::first()->enable_paystack)                                                        
                                    <option value="paystack">Paystack</option>
                                @endif
                                <option value="manual">Manual Funding</option>
                                <option value="bank">Auto Funding</option>
                            </select>
                        </div>
                    </div>
                    

                    <div id="manual-input-1" style="{{\App\Models\Settings::first()->enable_paystack ? 'display: none;' : 'display: block;'}}">
                        <div class="mb-3 p-2 border rounded">
                            <div class="mb-2">
                                <p class="mb-0">Account Number</p>
                                <p class="mb-0 fs-22px">
                                    {{$settings->account_no}}
                                </p>
                                <p class="mb-0 fs-16px mt-0">{{$settings->bank_name}}</p>
                                <p class="mb-0 mt-0">{{$settings->account_name}}</p>
                                <p><a href="https://api.whatsapp.com/send?phone=2348037610045&text=Hello, I just made a payment to through you website valueaddedtel.com">Contact Admin After Successful Payment </a></p>
                            </div>
                            <script>
                                document.getElementById('copy-btn-manual').addEventListener('click',
                                    function (e) {
                                        window.navigator.clipboard.writeText('{{"manual"}}')
                                        document.getElementById("copied-txt-manual").innerHTML = 'Copied'
                                        document.getElementById('copy-btn-manual').classList.remove('btn-primary')
                                        document.getElementById('copy-btn-manual').classList.add('btn-success')
                                        

                                        setTimeout(() => {
                                            document.getElementById("copied-txt-manual").innerHTML = 'Copy to Clipboard'
                                            document.getElementById('copy-btn-manual').classList.remove('btn-success')
                                            document.getElementById('copy-btn-manual').classList.add('btn-primary')
                                        }, 1000)
                                    }
                                )
                                </script>
                                <button class="clipboard-init btn btn-primary btn-block" type="button" id="copy-btn-manual" onclick="copyNumber(event)">
                                    <em class="clipboard-icon icon ni ni-copy"></em> 
                                    <span class="clipboard-text" id="copied-txt-manual" >Copy to Clipboard</span>
                                </button>
                        </div>
                    </div>

                    <div id="amount-input-1" style="{{\App\Models\Settings::first()->enable_paystack ? 'display: block;' : 'display: none;'}}" >
                        <div class="form-group" >
                            <label class="form-label" for="full-name">Enter amount</label>
                            <div class="form-control-wrap">
                                <input type="number" class="form-control" style="height: 60px; border-radius:10px" id="full-name" name="amount" required>
                            </div>
                        </div>
    
    
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Proceed</button>
                        </div> 
                    </div>


                    <div class="form-group" id="bank-input-1" style="display: none;">
                        <div class="alert alert-info mb-0">You will be charged <span class="fw-bold">&#8358;{{$settings->monnify_charge}}</span> for every transfer made to these accounts.</div>
                        @if ($user->has('bankAccount'))
                            <ul class="nav nav-tabs">
                                @foreach ( $user->bankAccount as $key => $bankAccount )
                                    <li class="nav-item">
                                        <a class="nav-link {{$key == 0 ? 'active' : ''}}" data-toggle="tab" href="#tabItem-{{$bankAccount->bankCode}}-1"><span>{{$bankAccount->bankName}}</span></a>
                                    </li>
                                @endforeach 
                            </ul>
                            <div class="tab-content">
                                @foreach ( $user->bankAccount as $key => $bankAccount )
                                    <div class="tab-pane {{$key == 0 ? 'active' : ''}}" id="tabItem-{{$bankAccount->bankCode}}-1">
                                        <div class="mb-3 p-2 border rounded">
                                            <div class="mb-2">
                                                <p class="mb-0">Account Number</p>
                                                <p class="mb-0 fs-22px">
                                                    {{$bankAccount->accountNumber}} 
                                                </p>
                                                <p class="mb-0 fs-16px mt-0">{{$bankAccount->bankName}}</p>
                                                <p class="mb-0 mt-0">{{$bankAccount->accountName}}</p>
                                            </div>
                                            <button class="clipboard-init btn btn-primary btn-block" type="button" id="copy-btn-{{$bankAccount->bankCode}}-3" >
                                                <em class="clipboard-icon icon ni ni-copy"></em> 
                                                <span class="clipboard-text" id="copied-txt-{{$bankAccount->bankCode}}-3" >Copy to Clipboard</span>
                                            </button>

                                            <script>
                                                document.getElementById('copy-btn-{{$bankAccount->bankCode}}-3').addEventListener('click',
                                                    function (e) {
                                                        window.navigator.clipboard.writeText('{{$bankAccount->accountNumber}}')
                                                        document.getElementById("copied-txt-{{$bankAccount->bankCode}}-3").innerHTML = 'Copied'
                                                        document.getElementById('copy-btn-{{$bankAccount->bankCode}}-3').classList.remove('btn-primary')
                                                        document.getElementById('copy-btn-{{$bankAccount->bankCode}}-3').classList.add('btn-success')
                                                        

                                                        setTimeout(() => {
                                                            document.getElementById("copied-txt-{{$bankAccount->bankCode}}-3").innerHTML = 'Copy to Clipboard'
                                                            document.getElementById('copy-btn-{{$bankAccount->bankCode}}-3').classList.remove('btn-success')
                                                            document.getElementById('copy-btn-{{$bankAccount->bankCode}}-3').classList.add('btn-primary')
                                                        }, 1000)
                                                    }
                                                )
                                                </script>
                                        </div>
                                    </div>
                                @endforeach 
                            </div>
                        @endif
                    </div>
                
                </form>
            </div>
        </div>
    </div>
</div>