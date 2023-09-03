<x-user-layout :user="$user" :selectedUser="$selectedUser">
    <div class="nk-block">
        <div class="nk-block-head">
            <h5 class="title">Personal Information</h5>
            <p>Basic info, like your name and address, that you use on Nio Platform.</p>
        </div><!-- .nk-block-head -->
        <div class="profile-ud-list">
            <div class="profile-ud-item">
                <div class="profile-ud wider">
                    <span class="profile-ud-label">Full Name</span>
                    <span class="profile-ud-value">{{$selectedUser->full_name}}</span>
                </div>
            </div>
            <div class="profile-ud-item">
                <div class="profile-ud wider">
                    <span class="profile-ud-label">Username</span>
                    <span class="profile-ud-value">{{$selectedUser->username}}</span>
                </div>
            </div>
            <div class="profile-ud-item">
                <div class="profile-ud wider">
                    <span class="profile-ud-label">Email Address</span>
                    <span class="profile-ud-value">{{$selectedUser->email}}</span>
                </div>
            </div>
            <div class="profile-ud-item">
                <div class="profile-ud wider">
                    <span class="profile-ud-label">Mobile Number</span>
                    <span class="profile-ud-value">{{$selectedUser->phone}}</span>
                </div>
            </div>
            <div class="profile-ud-item">
                <div class="profile-ud wider">
                    <span class="profile-ud-label">Referred By</span>
                    <span class="profile-ud-value">{{$selectedUser->referrer ? $selectedUser->referrer->username : ''}}</span>
                </div>
            </div>
        </div><!-- .profile-ud-list -->
    </div><!-- .nk-block -->
    <div class="nk-block">
        <div class="nk-block-head nk-block-head-line">
            <h6 class="title overline-title text-base">Bank Account Information</h6>
        </div><!-- .nk-block-head -->
        <div class="profile-ud-list">
            <div class="profile-ud-item">
                <div class="profile-ud wider">
                    <span class="profile-ud-label">Account Name</span>
                    <span class="profile-ud-value">{{$selectedUser->account_name}}</span>
                </div>
            </div>
            <div class="profile-ud-item">
                <div class="profile-ud wider">
                    <span class="profile-ud-label">Account Number</span>
                    <span class="profile-ud-value">{{$selectedUser->account_number}}</span>
                </div>
            </div>
            <div class="profile-ud-item">
                <div class="profile-ud wider">
                    <span class="profile-ud-label">Bank</span>
                    <span class="profile-ud-value">{{$selectedUser->bank_name}}</span>
                </div>
            </div>
        </div><!-- .profile-ud-list -->
    </div><!-- .nk-block -->
  
  <div class="nk-block">
        <div class="nk-block-head nk-block-head-line">
            <h6 class="title overline-title text-base">Monnify Bank Account Information</h6>
        </div><!-- .nk-block-head -->
		@if ($selectedUser->has('bankAccount'))
            <ul class="nav nav-tabs">
                @foreach ( $selectedUser->bankAccount as $key => $bankAccount )
                    <li class="nav-item">
                        <a class="nav-link {{$key == 0 ? 'active' : ''}}" data-toggle="tab" href="#tabItem-{{$bankAccount->bankCode}}-db"><span>{{$bankAccount->bankName}}</span></a>
                    </li>
                @endforeach 
            </ul>
            <div class="tab-content">
                
                @foreach ( $selectedUser->bankAccount as $key => $bankAccount )
                    <div class="tab-pane {{$key == 0 ? 'active' : ''}}" id="tabItem-{{$bankAccount->bankCode}}-db">
                        <div class="mb-3 p-2 border rounded">
                            <div class="mb-2">
                                <p class="mb-0">Account Number</p>
                                <p class="mb-0 fs-22px">
                                    {{$bankAccount->accountNumber}} 
                                </p>
                                <p class="mb-0 fs-16px mt-0">{{$bankAccount->bankName}}</p>
                                <p class="mb-0 mt-0">{{$bankAccount->accountName}}</p>
                            </div>
                            
                                <button class="clipboard-init btn btn-primary btn-block" id="copy-btn-{{$bankAccount->bankCode}}-db">
                                    <em class="clipboard-icon icon ni ni-copy"></em> 
                                    <span class="clipboard-text" id="copied-txt-{{$bankAccount->bankCode}}-db" >Copy to Clipboard</span>
                                </button>

                                <script>
                                document.getElementById('copy-btn-{{$bankAccount->bankCode}}-db').addEventListener('click',
                                    function (e) {
                                        window.navigator.clipboard.writeText('{{$bankAccount->accountNumber}}')
                                        document.getElementById("copied-txt-{{$bankAccount->bankCode}}-db").innerHTML = 'Copied'
                                        document.getElementById('copy-btn-{{$bankAccount->bankCode}}-db').classList.remove('btn-primary')
                                        document.getElementById('copy-btn-{{$bankAccount->bankCode}}-db').classList.add('btn-success')
                                        

                                        setTimeout(() => {
                                            document.getElementById("copied-txt-{{$bankAccount->bankCode}}-db").innerHTML = 'Copy to Clipboard'
                                            document.getElementById('copy-btn-{{$bankAccount->bankCode}}-db').classList.remove('btn-success')
                                            document.getElementById('copy-btn-{{$bankAccount->bankCode}}-db').classList.add('btn-primary')
                                        }, 1000)
                                    }
                                )
                                </script>
                        </div>
                    </div>
                @endforeach 
            </div>
        @endif
    </div><!-- .nk-block -->
</x-user-layout>