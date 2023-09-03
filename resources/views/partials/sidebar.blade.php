<!-- sidebar @s -->

<div class="nk-sidebar nk-sidebar-fixed " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-sidebar-brand">
            <a href="{{route('dashboard')}}" class="logo-link">
                <img class="logo-light logo-img" src="/img/logo.png" srcset="/img/logo.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="/img/logo.png" srcset="/img/logo.png 2x" alt="logo-dark">
            </a>
        </div>
        <div class="nk-menu-trigger mr-n2">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
        <div class="nk-sidebar-body" data-simplebar>
            <div class="nk-sidebar-content">
                @if (!$user->isAdmin)
                    <div class="nk-sidebar-widget d-none d-xl-block">
                        @if ($user->bankAccount()->exists())

                            <ul class="nav nav-tabs">
                                @foreach ( $user->bankAccount as $key => $bankAccount )
                                    <li class="nav-item">
                                        <a class="nav-link {{$key == 0 ? 'active' : ''}}" data-toggle="tab" href="#tabItem-{{$bankAccount->bankCode}}"><span>{{$bankAccount->bankName}}</span></a>
                                    </li>
                                @endforeach 
                            </ul>
                            <div class="alert alert-info mb-2">You will be charged <span class="fw-bold">&#8358;{{$settings->monnify_charge}}</span> for every transfer made to these accounts.</div>
                            <div class="tab-content">
                                @foreach ( $user->bankAccount as $key => $bankAccount )
                                    <div class="tab-pane {{$key == 0 ? 'active' : ''}}" id="tabItem-{{$bankAccount->bankCode}}">
                                        <div class="mb-3 p-2 border rounded">
                                            <div class="mb-2">
                                                <p class="mb-0">Account Number</p>
                                                <p class="mb-0 fs-22px">
                                                    {{$bankAccount->accountNumber}} 
                                                </p>
                                                <p class="mb-0 fs-16px mt-0">{{$bankAccount->bankName}}</p>
                                                <p class="mb-0 mt-0">{{$bankAccount->accountName}}</p>
                                            </div>
                                            <script>
                                                document.getElementById('copy-btn-{{$bankAccount->bankCode}}').addEventListener('click',
                                                    function (e) {
                                                        window.navigator.clipboard.writeText('{{$bankAccount->accountNumber}}')
                                                        document.getElementById("copied-txt-{{$bankAccount->bankCode}}").innerHTML = 'Copied'
                                                        document.getElementById('copy-btn-{{$bankAccount->bankCode}}').classList.remove('btn-primary')
                                                        document.getElementById('copy-btn-{{$bankAccount->bankCode}}').classList.add('btn-success')
                                                        

                                                        setTimeout(() => {
                                                            document.getElementById("copied-txt-{{$bankAccount->bankCode}}").innerHTML = 'Copy to Clipboard'
                                                            document.getElementById('copy-btn-{{$bankAccount->bankCode}}').classList.remove('btn-success')
                                                            document.getElementById('copy-btn-{{$bankAccount->bankCode}}').classList.add('btn-primary')
                                                        }, 1000)
                                                    }
                                                )
                                                </script>
                                                <button class="clipboard-init btn btn-primary btn-block" id="copy-btn-{{$bankAccount->bankCode}}" onclick="copyNumber(event)">
                                                    <em class="clipboard-icon icon ni ni-copy"></em> 
                                                    <span class="clipboard-text" id="copied-txt-{{$bankAccount->bankCode}}" >Copy to Clipboard</span>
                                                </button>
                                        </div>
                                    </div>
                                @endforeach 
                            </div>
                        @endif

                        <ul class="user-account-data gy-1">
                            <li>
                                <div class="user-account-label">
                                    <span class="sub-text">Main Balance</span>
                                </div>
                                <div class="user-account-value">
                                    <span class="lead-text">NGN {{number_format($user['wallet']['main_balance'], 2)}}</span>
                                </div>
                            </li>
                            <li>
                                <div class="user-account-label">
                                    <span class="sub-text">Referral Earnings</span>
                                </div>
                                <div class="user-account-value">
                                    <span class="sub-text">NGN {{number_format($user['wallet']['ref_commission'], 2)}}</span>
                                </div>
                            </li>
                            <li>
                                <div class="user-account-label">
                                    <span class="sub-text">Points Accumulated</span>
                                </div>
                                <div class="user-account-value">
                                    <span class="sub-text">{{number_format($user['wallet']['points'])}} PV</span>
                                </div>
                            </li>
                            <li>
                                <div class="user-account-label">
                                    <span class="sub-text">Bonus Earnings</span>
                                </div>
                                <div class="user-account-value">
                                    <span class="sub-text">NGN {{number_format($user['wallet']['bonus'], 2)}}</span>
                                </div>
                            </li>
                            <li>
                                <div class="user-account-label">
                                    <span class="sub-text">Cash Back</span>
                                </div>
                                <div class="user-account-value">
                                    <span class="sub-text">NGN {{number_format($user['wallet']['cash_back'], 2)}}</span>
                                </div>
                            </li>
                            <li>
                                <div class="user-account-label">
                                    <span class="sub-text" style="font-weight: bolder; color:#000000">Current membership Plan</span>
                                </div>
                                <div class="user-account-value">
                                    <span class="sub-text" style="font-weight: bolder; color:#000000">{{$user['plan']['package_name']}}</span>
                                </div>
                            </li>
                        </ul>
                        <div class="user-account-actions">
                            <ul class="g-3">
                                <li>
                                    <button type="button" class="btn btn-lg btn-primary" style="justify-content: center;" data-toggle="modal" data-target="#modalForm">Deposit</button>
                                </li>
                                <li><button data-toggle="modal" data-target="#withdrawalForm" class="btn btn-lg btn-warning"><span>Withdraw</span></button></li>
                            </ul>
                        </div>
                    </div>

                    <div class="nk-sidebar-menu">
                        <ul class="nk-menu">
                            <li class="nk-menu-heading">
                                <h6 class="overline-title">Menu</h6>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('dashboard')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                    <span class="nk-menu-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('profile')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-user-c"></em></span>
                                    <span class="nk-menu-text">My Account</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('wallet')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-wallet-alt"></em></span>
                                    <span class="nk-menu-text">Wallets</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('upgrade')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                                    <span class="nk-menu-text">Upgrade Package</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('referral')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                    <span class="nk-menu-text">Referral</span>
                                </a>
                            </li>
                            <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-box"></em></span>
                                    <span class="nk-menu-text">Buy Airtime</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="{{route('airtime')}}" class="nk-menu-link">
                                            <span class="nk-menu-text">Airtime</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{route('intl-bills')}}" class="nk-menu-link">
                                            <span class="nk-menu-text">International Bills</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{route('rechargepins')}}" class="nk-menu-link">
                                            <span class="nk-menu-text">Recharge Pins</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-wifi"></em></span>
                                    <span class="nk-menu-text">Buy Data</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="{{route('buy-data')}}" class="nk-menu-link">
                                            <span class="nk-menu-text">Data</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{route('smile')}}" class="nk-menu-link">
                                            <span class="nk-menu-text">Buy Smile Data</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-box"></em></span>
                                    <span class="nk-menu-text">TV Subscriptions</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="{{route('cable')}}?serviceID=dstv" class="nk-menu-link"><span class="nk-menu-text" style="font-weight: bolder;">DSTV Subscription</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{route('cable')}}?serviceID=gotv" class="nk-menu-link"><span class="nk-menu-text" style="font-weight: bolder;">GOTV Subscription</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{route('cable')}}?serviceID=startimes" class="nk-menu-link"><span class="nk-menu-text" style="font-weight: bolder;">Startimes</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{route('showmax')}}" class="nk-menu-link"><span class="nk-menu-text" style="font-weight: bolder;">Showmax</span></a>
                                    </li>
                                </ul><!-- .nk-menu-sub -->
                            </li><!-- .nk-menu-item -->
                            <li class="nk-menu-item">
                                <a href="{{route('education')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-book"></em></span>
                                    <span class="nk-menu-text">Education</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('electricity')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-alert"></em></span>
                                    <span class="nk-menu-text">Electricity Bills</span>
                                </a>
                            </li>
                            <!-- <li class="nk-menu-item has-sub">
                                <a href="#" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-files"></em></span>
                                    <span class="nk-menu-text">Other Payments</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="{{route('electricity')}}" class="nk-menu-link"><span class="nk-menu-text" style="font-weight: bolder;">Electricity Bills</span></a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="#" class="nk-menu-link"><span class="nk-menu-text" style="font-weight: bolder;">Recharge PINS</span></a>
                                    </li>
                                </ul>
                            </li> -->
                            <li class="nk-menu-item">
                                <a href="{{route('history')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-info"></em></span>
                                    <span class="nk-menu-text">VTU History</span>
                                </a>
                            </li>
                            <li class="nk-menu-item" style="margin-top:1rem">
                                <a href="{{route('logout')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-account-setting"></em></span>
                                    <span class="nk-menu-text">Logout</span>
                                </a>
                            </li>
                            <li class="nk-menu-item" style="margin-top:1rem">
                                <a href="https://t.me/Xtrarvaluetelecom" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-account-setting"></em></span>
                                    <span class="nk-menu-text">Join Telegram Community</span>
                                </a>
                            </li>
                            <li class="nk-menu-item" style="margin-top:1rem">
                                <a href="https://www.facebook.com/profile.php?id=100090981326171&mibextid=ZbWKwL" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-account-setting"></em></span>
                                    <span class="nk-menu-text">Connect On Facebook</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @elseif ($user->isAdmin)
                    <div class="nk-sidebar-menu">
                        <ul class="nk-menu">
                            <li class="nk-menu-heading">
                                <h6 class="overline-title">Menu</h6>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.dashboard')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                    <span class="nk-menu-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('profile')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-user-c"></em></span>
                                    <span class="nk-menu-text">Profile</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.users')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                    <span class="nk-menu-text">Users</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.users', ['sort' => 'pv'])}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                    <span class="nk-menu-text">Top Users</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.histories')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-mobile"></em></span>
                                    <span class="nk-menu-text">VTU Histories</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.deposits')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-wallet-in"></em></span>
                                    <span class="nk-menu-text">Deposits</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.withdrawals')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-wallet-out"></em></span>
                                    <span class="nk-menu-text">Withdrawals</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.transfers')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-money"></em></span>
                                    <span class="nk-menu-text">Transfers</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.packages')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-mobile"></em></span>
                                    <span class="nk-menu-text">Packages</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.dataplans')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-wifi"></em></span>
                                    <span class="nk-menu-text">Data Plan Settings</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{route('admin.settings')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                                    <span class="nk-menu-text">Settings</span>
                                </a>
                            </li>
                            <li class="nk-menu-item" style="margin-top:1rem">
                                <a href="{{route('logout')}}" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-account-setting"></em></span>
                                    <span class="nk-menu-text">Logout</span>
                                </a>
                            </li>
                            <li class="nk-menu-item" style="margin-top:1rem">
                                <a href="https://t.me/Xtrarvaluetelecom" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-account-setting"></em></span>
                                    <span class="nk-menu-text">Join Telegram Community</span>
                                </a>
                            </li>
                            <li class="nk-menu-item" style="margin-top:1rem">
                                <a href="https://www.facebook.com/profile.php?id=100090981326171&mibextid=ZbWKwL" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-account-setting"></em></span>
                                    <span class="nk-menu-text">Connect On Facebook</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- sidebar @e -->
