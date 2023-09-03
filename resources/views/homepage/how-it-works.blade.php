<?php
$siteName = config('constants.site.siteName');
$title = 'How It Works | ' . $siteName;
$description = '';
$keyword = '';
?>
@include('homepage.head')

<body>

    @include('homepage.header2')

    <div class="page-banner-area" style="background-image:url(home-img/airtime-recharge.jpg); background-repeat: none; background-size: cover; background-position: center;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <div class="page-banner-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                        <h2 class="text-white">How It Works</h2>
                        <ul>
                            <li>
                                <a href="./">Home</a>
                            </li>
                            <li class="text-white">How It Works</li>
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

    <!-- <div class="partner-area" style="padding-top: 40px; padding-bottom: 20px;">
        <div class="container">
            <div class="partner-title">
                <h3>How It Works</h3>
                <center>
                    <p class="col-lg-8"><?php print $siteName; ?> provides you with an unlimited platform to earn and
                        attain financial freedom
                        via unlimited horizontal downsides and ten levels deep vertically.</p>
                </center>
            </div>
        </div>
    </div> -->


    <div class="getting-started-area pt-100 pb-75">
        <div class="container">
            <div class="section-title">
                <h2>TIME TO LEVEL UP</h2>
                <span></span>

            </div>
            <center>
                <div class="row justify-content-center">

                    <div class="col-lg-4 col-sm-6">
                        <div class="single-getting-started-card" data-aos="fade-up" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                            <div class="">
                                <img src="home-assets/images/explore/explore-1.png" alt="image">
                            </div>
                            <h3>USE THE PRODUCT</h3>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="single-getting-started-card" data-aos="fade-up" data-aos-delay="60" data-aos-duration="600" data-aos-once="true">
                            <div class="">
                                <img src="home-assets/images/getting-started/getting-2.png" alt="image">
                            </div>
                            <h3>RECOMMEND THE BUSINESS IDEA</h3>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="single-getting-started-card" data-aos="fade-up" data-aos-delay="70" data-aos-duration="700" data-aos-once="true">
                            <div class="">
                                <img src="home-assets/images/getting-started/getting-3.png" alt="image">
                            </div>
                            <h3>BECOME AN AMBASSADOR</h3>
                            <p></p>
                        </div>
                    </div>


                </div>
            </center>
        </div>
    </div>


    <div class="getting-started-area-with-transparent ptb-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <div class="getting-started-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                        <span>Getting Started</span>
                        <h3>Get Set Up, An Opportunity; Knocking...</h3>
                        <div class="getting-started-accordion">
                            <div class="accordion" id="GettingAccordion">
                                <div class="accordion-item">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        1. Getting Started
                                    </button>
                                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#GettingAccordion">
                                        <div class="accordion-body">
                                            <p><?php print $siteName; ?> provides you with an unlimited Earnings of Referral Bonus, Team Bonus up to 10th level deep and Bonus on every transaction from you or your team members. <br>Here you don’t have to convince people to buy stuffs they don’t need. Airtime and Data is used by everyone. Basically this business opportunity is for ALL. All you need is connect others and they connect others too before you know it,you have build a network of hundreds, thousands and millions of Users.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        2. Earnings
                                    </button>
                                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#GettingAccordion">
                                        <div class="accordion-body">
                                            <p>


                                                Instant 25% Referral Bonus: For anyone you directly sponsor with your referral ID, you are paid 25% of their registration and upgrade fee instantly.<br>
                                                For example: If 10 persons register with your user ID and upgrade to 50k VIP Class Package, Xtrarvalue Added International Ltd will pay you #12,500 for each person. That is <br>12,500 x 10 = #125,000<br>
                                                For 100 is = #1,250,000<br>
                                                For 1000 is = #12,500,000<br>
                                                There is no limit to how many people you can directly sponsor.The more the merrier!


                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        3. Indirect Referral
                                    </button>
                                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#GettingAccordion">
                                        <div class="accordion-body">
                                            <p>
                                                DO I EARN WHEN MY DIRECT REFERRALS REFER THEIR PEOPLE? Yes! You get commission when your direct referrals refer people. And it doesn’t stop there. You are paid commission up to 10 level deep. where your direct referrals are placed on your 1st level. See analysis below:<br>
                                                1st Level. 25%<br>
                                                2nd Level. 5%<br>
                                                3rd Level. 2.5%<br>
                                                4th Level. 1.5%<br>
                                                5th - 10th Level. 1.0%
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        4. Activity Commision
                                    </button>
                                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#GettingAccordion">
                                        <div class="accordion-body">
                                            <p>
                                                You are paid 0.1% of every airtime and data recharged by everyone in your organization.<br><br>
                                                1% on every PHCN and Bill Payments
                                                <br><br>
                                                N40 on Cable subscription
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        5. Incentives, Rewards for PV
                                    </button>
                                    <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#GettingAccordion">
                                        <div class="accordion-body">
                                            <p>
                                                A.<br>
                                                Points: 10,000pv<br>
                                                Cash. : #80,000 <br>
                                                Incentive: Monthly Leadership <br>
                                                Bonus (For VIP and Ambassador Class)<br><br>

                                                B.<br>
                                                Points: 25,000pv<br>
                                                Cash. :#500,000 or<br>
                                                Incentive : Local Trip Fund<br><br>

                                                C.<br>
                                                Points: 60,000pv<br>
                                                Cash. :#1,500,000 or<br>
                                                Incentive: International Trip Fund<br><br>

                                                D.<br>
                                                Points : 100,000pv<br>
                                                Cash. : #3,500,000 or<br>
                                                Incentive : Car Fund<br><br>

                                                E.<br>
                                                Points. : 250,000pv<br>
                                                Cash. : 5,000,000 or<br>
                                                Incentive: House Fund <br><br>

                                                F.<br>
                                                Points: 500,000pv<br>
                                                Cash. : 6,000,000<br>
                                                Incentive: SUV Fund<br><br>

                                                G.<br>
                                                Points. : 1,000,000<br>
                                                Cash. : #8,000,000 or<br>
                                                Incentive: 3 Bedroom Bungalow<br><br>

                                                H.<br>
                                                Points. : 2,000,<br>
                                                Cash. : Profit Sharing (Products)<br><br>


                                                Congratulations. Welcome to a world of endless possibilities.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="getting-started-image" data-aos="fade-left" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                        <img src="home-img/top-up-services.jpg" alt="image" />
                        <div class="video-view" data-speed="0.08" data-revert="true">
                            <a href="https://www.youtube.com/watch?v=ODfy2YIKS1M" class="video-btn popup-youtube">
                                <i class="ri-play-circle-line"></i>
                            </a>
                        </div>
                        <div class="getting-shape">
                            <img src="home-assets/images/getting-started/shape-1.png" alt="image" />
                        </div>
                        <div class="getting-shape-2">
                            <img src="home-assets/images/getting-started/shape-2.png" alt="image" />
                        </div>
                        <div class="getting-shape-3">
                            <img src="home-assets/images/getting-started/shape-3.png" alt="image" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('homepage.add-earn-chat')

    @include('homepage.footer')