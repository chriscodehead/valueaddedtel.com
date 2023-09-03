<?php
$siteName = config('constants.site.siteName');
$title = 'About | Earn Extra Cash with ' . $siteName;
$description = '';
$keyword = '';
?>
@include('homepage.head')

<body>

    @include('homepage.header2')

    <div class="page-banner-area" style="background-image:url(home-img/people-meeting-discussion-sharing-studying-concept.jpg); background-repeat: none; background-size: cover; background-position: center;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <div class="page-banner-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                        <h2 class="text-white">About Us</h2>
                        <ul>
                            <li>
                                <a href="./">Home</a>
                            </li>
                            <li class="text-white">About Us</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="page-banner-image" data-aos="fade-left" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                        <img src="home-img/top-up-add-your-money-balance.png" alt="image" />
                        <div class="banner-shape">
                            <img src="home-assets/images/page-banner/shape.png" alt="image" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="partner-area" style="padding-top: 70px; padding-bottom: 50px;">
        <div class="container">
            <div class="partner-title">
                <h3>Discover A Better Way To Pay Bills With Ease and Earn Extra Cash</h3>
            </div>
        </div>
    </div>

    <div class="reliable-area pb-100">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-6 col-md-12">
                    <div class="reliable-content with-padding-left" data-aos="fade-left" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                        <span>Reliable Online Top-Up Platform</span>
                        <h3>Welcome to <?php print $siteName; ?></h3>
                        <p>
                            <?php print $siteName; ?> is a Limited Liability company registered with the
                            Corporate Affair Commission since 2017 and license on sale and distribution of online
                            data,Airtime etc across mobile network in Nigeria.
                        </p>
                        <p class="pt-3">
                            <b>OUR MISSION:</b> To provide extra value quality online mobile telecom services
                            and to create Financial Freedom for Partners.
                        </p>
                        <p class="pt-3">
                            <b>OUR VISION:</b> To provide 1st class telecom services for the eradication of
                            Poverty.
                        </p>
                        <div class="row justify-content-center">
                            <div class="col-lg-6 col-md-6">
                                <ul class="reliable-list">
                                    <li><i class="ri-check-line"></i> Earn Huge Commissions</li>
                                    <li><i class="ri-check-line"></i> Instant Withdrawal</li>
                                    <li><i class="ri-check-line"></i> Excellent Customer Support</li>
                                    <li><i class="ri-check-line"></i>Safe, Secured Payment</li>
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <ul class="reliable-list">
                                    <li><i class="ri-check-line"></i> Free Plan Available</li>
                                    <li><i class="ri-check-line"></i> Business Growth</li>
                                    <li><i class="ri-check-line"></i> Auto-Wallet Funding</li>
                                    <li><i class="ri-check-line"></i> Fast Service Delivery</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="reliable-image-wrap" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-sm-6">
                                <div class="wrap-image" data-aos="fade-down" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                                    <img src="home-img/recharg-phone-45.png" alt="image" />
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="wrap-image mb-25" data-aos="fade-down" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                                    <img src="home-img/girl-drink-coffee-phone-topup.jpg" alt="image" />
                                </div>
                                <div class="wrap-image" data-aos="fade-up" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                                    <img src="home-img/jealous-topup.jpg" alt="image" />
                                </div>
                            </div>
                        </div>
                        <div class="reliable-shape">
                            <img src="home-assets/images/reliable/shape-2.png" alt="image" />
                        </div>
                        <div class="reliable-shape-2">
                            <img src="home-assets/images/reliable/shape-1.png" alt="image" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="paiement-area ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="paiement-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                        <span>Our Services Worldwide</span>
                        <h3>Enjoy our Services While You Save And Earn More Money</h3>
                        <p>
                            The most popular payment platform in Nigeria offers millions of customers a quick and simple
                            online payment option. By making sure payments for the regular services you use don't cause
                            you any worry, we are changing lives. You may do speedy transactions using any device and
                            anywhere with Xtrarvalue Added.
                        </p>

                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="paiement-image" data-aos="fade-up" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                        <img src="home-assets/images/paiement.png" alt="image" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('homepage.cert')

    @include('homepage.footer')
