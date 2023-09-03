<?php
$siteName = config('constants.site.siteName');
$title = $siteName . ' | TopUp To Earn';
$description = '';
$keyword = '';
?>
@include('homepage.head')

<body>

    @include('homepage.header')

    <div class="main-banner-area">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-12" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                    <div class="main-banner-content">
                        <span><img src="home-img/mtn.png" width="30" alt="image">
                            <img src="home-img/9mobile.png" width="30" alt="image">
                            <img src="home-img/airtel.png" width="30" alt="image">
                            <img src="home-img/glol.png" width="30" alt="image">
                            <img src="home-img/electricity.png" width="30" alt="image">
                            <img src="home-img/internet-data.png" width="30" alt="image">
                            <img src="home-img/international-airtime.png" width="30" alt="image">
                        </span>
                        <h6>{{$siteName}}</h6>
                        <h1>A Better Way To Pay Bills With Ease and Earn Extra Cash.</h1>
                        <p>Mobile Airtime, Data Card Printing, Electricity bills, Cable TV Subscription, Internet Data, Recharge Card Printing, Building Networking and lot more. <a href="services">Learn more</a></p>
                        <div class="banner-btn">
                            <a href="register" class="default-btn">Create Account</a>
                            <a href="login" class="default-btn" style="background: #ff6b0d;">Sign In</a>
                        </div>
                        <ul class="trust-content">
                            <li>
                                <!--<img src="home-assets/images/main-banner/line-graph.png" alt="image">-->
                                <span>Over 100k+ Customers</span>
                            </li>
                            <li>
                                <!--<img src="home-assets/images/main-banner/diamond.png" alt="image">-->
                                <span>Fast And Hassle-Free</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="main-banner-image" data-speed="0.05" data-revert="true">
                        <!--<img src="home-assets/images/main-banner/banner-women.png" alt="image" data-aos="fade-down"
                            data-aos-delay="50" data-aos-duration="500" data-aos-once="true">-->
                        <img src="home-img/recharg-phone-45.png" alt="image" data-aos="fade-down" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                    </div>
                </div>
                <div class="col-lg-4 col-md-12" data-aos="fade-left" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                    <form class="money-transfer-form">
                        <div class="amount-currency-total-content">
                            <h1><span>Easy Top Up Services</span></h1>
                            <h3><img src="home-img/mtn.png" width="20" alt="image">
                                <img src="home-img/9mobile.png" width="20" alt="image">
                                <img src="home-img/airtel.png" width="20" alt="image">
                                <img src="home-img/glol.png" width="20" alt="image">
                            </h3>
                        </div>
                        <div class="money-transfer-content">
                            <div class="form-group">
                                <label>Enter Phone Number:</label>
                                <input type="text" class="form-control" autocomplete="off" value="" placeholder="08011111111">
                                <div class="dropdown amount-currency-select">
                                    <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <img src="home-img/mtn.png" alt="flag">
                                        <span class="currency-name"></span>
                                    </button>
                                    <div style="z-index:100;" class="dropdown-menu currency-dropdown-menu">
                                        <a class="dropdown-item">
                                            <img src="home-img/mtn.png" alt="flag">
                                            MTN
                                        </a>
                                        <a class="dropdown-item">
                                            <img src="home-img/9mobile.png" alt="flag">
                                            9Mobile
                                        </a>
                                        <a class="dropdown-item">
                                            <img src="home-img/airtel.png" alt="flag">
                                            Airtel
                                        </a>
                                        <a class="dropdown-item">
                                            <img src="home-img/glol.png" alt="flag">
                                            GLO
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <ul class="amount-currency-info">
                                <li class="d-flex justify-content-between align-items-center">
                                    <div class="info-icon">
                                        <i class="ri-subtract-line"></i>
                                    </div>
                                    <div class="info-left">
                                        <b>Earn 2% </b>
                                    </div>
                                    <div class="info-right">
                                        <span>
                                            FOR EVERY AIRTIME AND DATA SUBS
                                        </span>
                                    </div>
                                </li>
                                <!--<li class="d-flex justify-content-between align-items-center">
                                <div class="info-icon">
                                    <i class="ri-pause-line"></i>
                                </div>
                                <div class="info-left">
                                    <span>Earn ₦40</span>
                                </div>
                                <div class="info-right">
                                    <span>FOR EVERY CABLE SUBSCRIPTION </span>
                                </div>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <div class="info-icon">
                                    <i class="ri-close-fill"></i>
                                </div>
                                <div class="info-left">
                                    <span>Earn 1%</span>
                                </div>
                                <div class="info-right">
                                    <span>FOR EVERY ELECTRICITY PAYMENT</span>
                                </div>
                            </li>-->
                            </ul>
                            <div style="z-index:1;" class="form-group">
                                <label>Amount:</label>
                                <input type="number" class="form-control" autocomplete="off" value="100">
                            </div>
                            <div style="z-index:1; margin-top:3px;" class="form-group">
                                <label>Email:</label>
                                <input type="email" class="form-control" autocomplete="off" placeholder="example@gmail.com">
                            </div>
                            <div class="amount-delivery-time">
                                <span>Easy, Fast and <b>Secured</b></span>
                            </div>
                            <ul class="amount-btn-group">

                                <li>
                                    <button type="button" class="optional-btn">Continue</button>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="main-banner-shape" data-speed="0.08" data-revert="true">
            <img src="home-assets/images/main-banner/shape-1.png" alt="image">
        </div>
        <div class="main-banner-shape-2" data-speed="0.08" data-revert="true">
            <img src="home-assets/images/main-banner/shape-2.png" alt="image">
        </div>
    </div>

    <div class="getting-started-area pt-100 pb-75">
        <div class="container">
            <div class="section-title">
                <span>Get Started</span>
                <h2>Get Set Up And Start Earning From Every Step You Take</h2>
            </div>
            <center>
                <div class="row justify-content-center">

                    <div class="col-lg-3 col-sm-6">
                        <div class="single-getting-started-card" data-aos="fade-up" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                            <div class="">
                                <img src="home-assets/images/explore/explore-1.png" alt="image">
                            </div>
                            <h3>Create Account</h3>
                            <p>Contact a registered partner to register you with his or her referral Link Or Click Register at the top of the website to do that with his/her referral Link.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-getting-started-card" data-aos="fade-up" data-aos-delay="60" data-aos-duration="600" data-aos-once="true">
                            <div class="">
                                <img src="home-assets/images/getting-started/getting-2.png" alt="image">
                            </div>
                            <h3>FUND WALLET</h3>
                            <p>Use any of these handy payment options to top up your wallet. Online Payment, Mobile
                                Transfer. Very secured and fast.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-getting-started-card" data-aos="fade-up" data-aos-delay="70" data-aos-duration="700" data-aos-once="true">
                            <div class="">
                                <img src="home-assets/images/getting-started/getting-3.png" alt="image">
                            </div>
                            <h3>PLACE YOUR ORDER</h3>
                            <p>All orders are processed promptly, and all recharge and bill payment services are given
                                instantly. The process is swift and no delays.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-getting-started-card" data-aos="fade-up" data-aos-delay="80" data-aos-duration="800" data-aos-once="true">
                            <div class="">
                                <img src="home-assets/images/getting-started/getting-4.png" alt="image">
                            </div>
                            <h3>INSTANT CASH-BACK</h3>
                            <p>Following a successful transaction, CashBack Value will be paid to your CashBack wallet
                                and will be available for withdrawal at any time.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-getting-started-card" data-aos="fade-up" data-aos-delay="80" data-aos-duration="800" data-aos-once="true">
                            <div class="">
                                <img src="home-assets/images/getting-started/getting-4.png" alt="image">
                            </div>
                            <h3>Work with people</h3>
                            <p>Work with people who like what you do, that may be club, a church, an association or a craft.grow Your Team. <br>Assemble an initial list of at least 200 names, and you will find out that 50 will be yours.Sell recharge and get paid products and be the first user of the products. Whatever it maybe, it is good when you have something other than MLM income.</p>
                        </div>
                    </div>

                </div>
            </center>
        </div>
    </div>


    <div class="why-choose-us-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="why-choose-us-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                        <span>Why Choose Us</span>
                        <h3>Welcome to <?php print $siteName; ?></h3>
                        <p><?php print $siteName; ?> is a Limited Liability company registered with the Corporate Affair Commission since 2017 and also NCC License on sale and distribution of online data, Airtime etc across mobile network in Nigeria.</p>
                        <ul class="choose-us-list">
                            <li>
                                <i class="ri-checkbox-circle-line"></i>
                                Our telecommunication platform guarantees you, Financial Freedom and Lifestyle with the possibility of making over 300,000 Monthly on your purchases of airtime,data, cable Tv subscriptions, bill payments and building your network marketing team.
                            </li>
                            <li>
                                <i class="ri-checkbox-circle-line"></i>
                                <?php print $siteName; ?> provides you with an unlimited Earnings of Referral Bonus, Team Bonus up to 10th level deep and Bonus on every transaction from you or your team members.
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="why-choose-us-image">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-sm-6">
                                <div class="choose-image" data-aos="fade-down" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                                    <img src="home-img/caucasian-family-is-enjoying-summer-vacation_53876-138042.avif" alt="image">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="choose-image mb-25" data-aos="fade-left" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                                    <img src="home-img/young-african-people-white-background-with-hands-raised-up_219728-3398.jpg" alt="image">
                                </div>
                                <div class="choose-image" data-aos="fade-up" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                                    <img src="home-img/team-business-people-collaborating-plan-financial-strategy-doing-teamwork-create-sales-report-laptop-office-employees-working-project-strategy-analyze-career-growth_482257-39530.avif" alt="image">
                                </div>
                            </div>
                        </div>
                        <div class="choose-shape" data-speed="0.08" data-revert="true">
                            <img src="home-assets/images/why-choose-us/shape-1.png" alt="image">
                        </div>
                        <div class="choose-shape-2" data-speed="0.08" data-revert="true">
                            <img src="home-assets/images/why-choose-us/shape-2.png" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .mybutton {
            display: block;
            width: 100%;
            border: none;
            background-color: #ff6b0d;
            color: white;
            padding: 14px 28px;
            cursor: pointer;
        }

        .mybutton:hover {
            background-color: #ddd;
            color: black;
        }
    </style>

    <div class="coverage-area pt-100 pb-75">
        <div class="container">
            <div class="section-title">
                <span>Make Payments</span>
                <h2>Select the service you want to make payment for</h2>
            </div>
            <div class="row justify-content-left">
                <h2 class="mybutton">Airtime Recharge</h2>
                <div class="mydiv col-12">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/mtn.png" alt="image">
                                    </div>
                                    <h3>MTN Airtime VTU</h3>
                                    <p>MTN airtime - Get instant Top up</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/airtel.png" alt="image">
                                    </div>
                                    <h3>Airtel Airtime VTU</h3>
                                    <p>Airtel airtime - Get instant top up</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/glol.png" alt="image">
                                    </div>
                                    <h3>GLO Airtime VTU</h3>
                                    <p>Glo airtime - Get instant Top up</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/9mobile.png" alt="image">
                                    </div>
                                    <h3>9mobile Airtime VTU</h3>
                                    <p>9mobile Airtime- Get instant top up</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/smile.png" alt="image">
                                    </div>
                                    <h3>Smile Network Payment</h3>
                                    <p>Smile Airtime and Internet Data</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/international-airtime.png" alt="image">
                                    </div>
                                    <h3>International Airtime</h3>
                                    <p>Pay for airtime across the Globe</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-left">
                <h2 class="mybutton">Data Services</h2>
                <div class="mydiv col-12">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/mtn.png" alt="image">
                                    </div>
                                    <h3>MTN DATA</h3>
                                    <p>MTN Data - Get instant Top up</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/airtel.png" alt="image">
                                    </div>
                                    <h3>Airtel DATA</h3>
                                    <p>Airtel Data - Get instant top up</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/glol.png" alt="image">
                                    </div>
                                    <h3>GLO DATA</h3>
                                    <p>Glo Data - Get instant Top up</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/9mobile.png" alt="image">
                                    </div>
                                    <h3>9mobile DATA</h3>
                                    <p>9mobile Data - Get instant top up</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/smile.png" alt="image">
                                    </div>
                                    <h3>Smile Network Payment</h3>
                                    <p>Smile Airtime and Internet Data</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- data-aos="fade-up" data-aos-delay="50" data-aos-duration="500"
                                data-aos-once="true" -->
            <div class="row justify-content-left">
                <h2 class="mybutton">Electricity Bill</h2>
                <div class="mydiv col-12">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/Ikeja-Electric-Payment-PHCN.jpg" alt="image">
                                    </div>
                                    <h3>Ikeja Electric Payment - IKEDC</h3>
                                    <p>Prepaid and Postpaid IKEDC payment.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/eedc.png" alt="image">
                                    </div>
                                    <h3>Enugu Electric Payment - EEDC</h3>
                                    <p>Prepaid and Postpaid EEDC payment.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/Eko-Electric-Payment-PHCN.jpg" alt="image">
                                    </div>
                                    <h3>Eko Electric Payment - EKEDC</h3>
                                    <p>Postpaid and Prepaid EKEDC payment</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/Abuja-Electric.jpg" alt="image">
                                    </div>
                                    <h3>Abuja Electricity - AEDC</h3>
                                    <p>AEDC - Abuja Electricity Distribution Company</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/Kano-Electric.jpg" alt="image">
                                    </div>
                                    <h3>KEDCO - Kano Electric</h3>
                                    <p>Kano Electricity - KEDCO Bills Payment</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/Port-Harcourt-Electric.jpg" alt="image">
                                    </div>
                                    <h3>PHED - Port Harcourt Electric</h3>
                                    <p>Port-Harcourt Electric Payment - PHED</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/Jos-Electric-JED.jpg" alt="image">
                                    </div>
                                    <h3>Jos Electric - JED</h3>
                                    <p>JED - Jos Electricity Prepaid and Postpaid Payment</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/Kaduna-Electric-KAEDCO.jpg" alt="image">
                                    </div>
                                    <h3>Kaduna Electric - KAEDCO</h3>
                                    <p>KAEDCO - Kaduna Electricity Prepaid and Postpaid Payment</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/IBEDC-Ibadan-Electricity-Distribution-Company.jpg" alt="image">
                                    </div>
                                    <h3>IBEDC - Ibadan Electricity</h3>
                                    <p>IBEDC - Ibadan Electricity Distribution</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row justify-content-left">
                <h2 class="mybutton">TV Subscription</h2>
                <div class="mydiv col-12">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/dstv.png" alt="image">
                                    </div>
                                    <h3>DSTV Subscription</h3>
                                    <p>Choose from a range of DStv bouquets for your entertainment. Easy payment, quick value
                                        delivery.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/gotv.png" alt="image">
                                    </div>
                                    <h3>Gotv Payment</h3>
                                    <p>Choose from a range of GOtv bouquets for your entertainment. Easy payment, quick value
                                        delivery.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/startime.png" alt="image">
                                    </div>
                                    <h3>Startimes Subscription</h3>
                                    <p>Choose from a range of Startimes bouquets for your entertainment. Easy payment, quick
                                        value delivery.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="single-coverage-card">
                                <div class="content">
                                    <div class="coverage-image">
                                        <img src="home-img/showmax.png" alt="image">
                                    </div>
                                    <h3>ShowMax Subscription</h3>
                                    <p>Choose from a range of ShowMax viewing subscription bouquets for your entertainment. Easy
                                        payment, quick value delivery.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <div class="coverage-shape">
            <img src="home-assets/images/coverage/shape-1.png" alt="image">
        </div>
        <div class="coverage-shape-2">
            <img src="home-assets/images/coverage/shape-2.png" alt="image">
        </div>
    </div>



    @include('homepage.add-earn-chat')


    <div class="coverage-area ptb-100">
        <div class="container">
            <div class="section-title">
                <span>Our Review</span>
                <h2>More Than 10k Happy Customers Trust Our Services</h2>
            </div>
            <div class="review-slides owl-carousel owl-theme">
                <div class="single-review-box" data-aos="fade-up" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                    <ul class="review-rating">
                        <li><i class="ri-star-line"></i></li>
                        <li><i class="ri-star-line"></i></li>
                        <li><i class="ri-star-line"></i></li>
                        <li><i class="ri-star-line"></i></li>
                        <li><i class="ri-star-line"></i></li>
                    </ul>
                    <p>I have been using {{$siteName}} for all my airtime, data, and cable needs, and 
                    it has been a fantastic experience. The platform is user-friendly, making it easy for 
                    me to navigate and purchase what I need. The multilevel system is an added bonus,
                    allowing me to earn rewards and benefits as I introduce others to this amazing service. 
                    I highly recommend {{$siteName}} to anyone looking for a convenient and efficient way 
                    to stay connected.</p>
                    <div class="reviewquote-image">
                        <img src="home-assets/images/quote-icon.png" alt="image">
                    </div>
                    <div class="review-info">
                        <h3>Thomoson Piterson</h3>
                        <span>School Teacher</span>
                    </div>
                </div>
                <div class="single-review-box" data-aos="fade-up" data-aos-delay="60" data-aos-duration="600" data-aos-once="true">
                    <ul class="review-rating">
                        <li><i class="ri-star-line"></i></li>
                        <li><i class="ri-star-line"></i></li>
                        <li><i class="ri-star-line"></i></li>
                        <li><i class="ri-star-line"></i></li>
                        <li><i class="ri-star-line"></i></li>
                    </ul>
                    <p>I'm incredibly satisfied with {{$siteName}}. It has simplified my life 
                    by providing a one-stop solution for all my telecommunication needs. Whether it's buying airtime, 
                    data, or cable subscriptions, the platform offers a seamless and secure experience. 
                    The multilevel system is a unique feature that has allowed me to not only save money 
                    but also earn additional rewards. 
                    {{$siteName}} is definitely my go-to platform, and I recommend it to everyone.</p>
                    <div class="reviewquote-image">
                        <img src="home-assets/images/quote-icon.png" alt="image">
                    </div>
                    <div class="review-info">
                        <h3>Maxwel Ade</h3>
                        <span>Civil Servant</span>
                    </div>
                </div>
                <div class="single-review-box" data-aos="fade-up" data-aos-delay="70" data-aos-duration="700" data-aos-once="true">
                    <ul class="review-rating">
                        <li><i class="ri-star-line"></i></li>
                        <li><i class="ri-star-line"></i></li>
                        <li><i class="ri-star-line"></i></li>
                        <li><i class="ri-star-line"></i></li>
                        <li><i class="ri-star-line"></i></li>
                    </ul>
                    <p>{{$siteName}} has revolutionized the way I manage my telecommunication services. 
                    With just a few clicks, I can easily purchase airtime, data, and cable 
                    subscriptions without any hassle. The platform is reliable, and the transactions are 
                    always smooth and fast. The multilevel system is a game-changer, giving me the 
                    opportunity to earn passive income while enjoying the convenience of the service. 
                    I'm extremely pleased with{{$siteName}} and 
                    would recommend it to anyone seeking a convenient and rewarding telecommunication solution.</p>
                    <div class="reviewquote-image">
                        <img src="home-assets/images/quote-icon.png" alt="image">
                    </div>
                    <div class="review-info">
                        <h3>John Okafor</h3>
                        <span>Trader</span>
                    </div>
                </div>
            </div>
            <div class="review-optional-content">
                <p>But don’t just take our word for it - check out what our customers have to say about their experience
                    with us: <b>Excellent</b> <span>Based on 5,454 reviews</span></p>
            </div>
        </div>
    </div>

<!--data-aos="fade-right" data-aos-delay="50" data-aos-duration="500" data-aos-once="true"-->
    <div class="app-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="app-content" >
                        <span>Download Our Mobile App</span>
                        <h3>You Can Find All The Thing You Need In Our Mobile App</h3>
                        <p>
                            Coming soon...
                        </p>
                        <div class="app-btn-box">
                            <a title="coming soon..." href="javascript:" class="appstore-btn">
                                <i class="ri-apple-fill"></i>
                                Download On
                                <span>App Store</span>
                            </a>
                            <a title="coming soon..." href="javascript:" class="google-btn">
                                <i class="ri-google-line"></i>
                                Download On
                                <span>Google Play</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <!--data-aos="fade-up" data-aos-delay="50" data-aos-duration="500" data-aos-once="true"-->
                    <div class="app-image" >
                        <img src="home-assets/images/app.png" alt="image" />
                        <!--data-aos="fade-down" data-aos-delay="70" data-aos-duration="700" data-aos-once="true"-->
                        <div class="circle-pattern" ></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--data-aos="fade-up" data-aos-delay="50" data-aos-duration="500" data-aos-once="true"-->
    <div class="overview-area ptb-100">
        <div class="container">
            <div class="overview-content" >
                <span>Our Mission</span>
                <h3>To provide extra value quality online mobile telecom services and to create Financial Freedom for
                    Partners.</h3>
                <ul class="overview-btn-group">
                    <li>
                        <a href="register" class="default-btn">Join Us</a>
                    </li>
                    <li>
                        <a href="how-it-works" class="optional-btn">Start Earning</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="overview-shape">
            <img src="home-assets/images/overview/shape-1.png" alt="image">
        </div>
        <div class="overview-shape-2">
            <img src="home-assets/images/overview/shape-2.png" alt="image">
        </div>
    </div>


    @include('homepage.footer')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.mydiv').hide();

            $(function() {
                $(".mybutton").click(function() {
                    $(this).next(".mydiv").toggle("slow");
                });
            });

        });
    </script>