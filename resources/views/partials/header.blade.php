<!-- wrap @s -->
<div class="nk-wrap ">
    <!-- main header @s -->
    <div class="nk-header nk-header-fluid nk-header-fixed is-light">
        <div class="container-fluid">
            <div class="nk-header-wrap">
                <div class="nk-menu-trigger d-xl-none ml-n1">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                </div>
                <div class="nk-header-brand d-xl-none">
                    <a href="{{route('dashboard')}}" class="logo-link">
                        <img class="logo-light logo-img" src="/img/logo.png" srcset="/img/logo.png 2x" alt="logo">
                        <img class="logo-dark logo-img" src="/img/logo.png" srcset="/img/logo.png 2x" alt="logo-dark">
                    </a>
                </div>
                <div class="nk-header-news d-none d-xl-block">
                    <div class="nk-news-list">
                        <div class="nk-news-text">
                            <p><?php print @$title; ?></p>
                        </div>
                    </div>
                </div>
                <div class="nk-header-tools">
                    <ul class="nk-quick-nav">
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <div class="user-toggle">
                                    <div class="user-avatar sm">
                                        <em class="icon ni ni-user-alt"></em>
                                    </div>
                                    <div class="user-info d-none d-md-block">
                                        <div class="user-name dropdown-indicator">{{$user['fullname']}}</div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                    <div class="user-card">
                                        <div class="user-avatar">
                                            <span>AB</span>
                                        </div>
                                        <div class="user-info">
                                            <span class="lead-text">{{$user['fullname']}}</span>
                                            <span class="sub-text">{{$user['email']}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li><a href="{{route('profile')}}"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                        <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li><a href="{{route('logout')}}"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- main header @e -->