<?php
$sitePhone = config('constants.site.sitePhone');
$siteEmail = config('constants.site.siteEmail');
$siteCAC = config('constants.site.siteCAC');
$siteNCC = config('constants.site.siteNCC');
?>
<div class="preloader">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="lds-spinner">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
</div>

<header class="main-header-area">
    <div class="topbar-area">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <ul class="topbar-information">
                        <li>
                            <a href="tel:<?php print $sitePhone; ?>"><?php print $sitePhone; ?></a>
                        </li>
                        <li>
                            <a href="mailto:<?php print $siteEmail; ?>"><span class="__cf_email__"><?php print $siteEmail; ?></span></a>
                        </li>
                        <li>
                            <a href="#">NCC:<?php print $siteNCC; ?>, CAC:<?php print $siteCAC; ?></a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6">
                    <ul class="topbar-action">
                        <li>
                            <a href="contact">Support</a>
                        </li>
                        <li>
                            <a href="mailto:<?php print $siteEmail; ?>">Help</a>
                        </li>
                        <li class="dropdown language-option">
                            <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ri-global-line"></i>
                                <span class="lang-name"></span>
                            </button>
                            <div class="dropdown-menu language-dropdown-menu">
                                <a class="dropdown-item">
                                    <div id="google_translate_element"> </div>
                                </a>
                                <!-- <a class="dropdown-item" href="#">
                                    <img src="assets/images/china.png" alt="flag">
                                    简体中文
                                </a>
                                <a class="dropdown-item" href="#">
                                    <img src="assets/images/uae.png" alt="flag">
                                    العربيّة
                                </a> -->
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="navbar-area">
        <div class="main-responsive-nav">
            <div class="container">
                <div class="main-responsive-menu">
                    <div class="logo">
                        <a href="./">
                            <img src="home-img/logo-main.png" class="black-logo" alt="image">
                            <!--<img src="home-img/logo-main.png" class="white-logo" alt="image">-->
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-navbar">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="./">
                        <img src="home-img/logo-main.png" class="black-logo" alt="image">
                        <!--<img src="home-img/logo-main.png" class="white-logo" alt="image">-->
                    </a>
                    <div class="navbar-list">
                        <ul>
                            <li><a href="{{route('how-it-works')}}">Top Up</a></li>
                            <li><a href="{{route('how-it-works')}}">Start Earning </a></li>
                        </ul>
                    </div>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a href="{{route('about')}}" class="nav-link">About</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('how-it-works')}}" class="nav-link">How it works</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('packages')}}" class="nav-link">Packages</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('incentives')}}" class="nav-link">Incentives</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="faq" class="nav-link">FAQs</a>
                            </li> -->
                            <li class="nav-item">
                                <a href="{{route('contact')}}" class="nav-link">Contact</a>
                            </li>
                        </ul>
                        <div class="others-options d-flex align-items-center">
                            <div class="option-item">
                                <a href="login" class="optional-btn">Log In</a>
                            </div>
                            <div class="option-item">
                                <a href="register" class="default-btn">Register Now</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="others-option-for-responsive">
            <div class="container">
                <div class="dot-menu">
                    <div class="inner">
                        <div class="circle circle-one"></div>
                        <div class="circle circle-two"></div>
                        <div class="circle circle-three"></div>
                    </div>
                </div>
                <div class="container">
                    <div class="option-inner">
                        <div class="others-options d-flex align-items-center">
                            <div class="option-item">
                                <a href="login" class="optional-btn">Log In</a>
                            </div>
                            <div class="option-item">
                                <a href="register" class="default-btn">Register Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>