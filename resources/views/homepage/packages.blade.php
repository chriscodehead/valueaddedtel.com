<?php
$siteName = config('constants.site.siteName');
$title = 'Our Packages | ' . $siteName;
$description = '';
$keyword = '';
?>

@include('homepage.head')

<body>

    @include('homepage.header2')

    <div class="page-banner-area" style="background-image:url(home-img/registration-application-paper-form-concept.jpg); background-repeat: none; background-size: cover; background-position: center;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <div class="page-banner-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                        <h2 class="text-white">Our Packages</h2>
                        <ul>
                            <li>
                                <a href="./">Home</a>
                            </li>
                            <li class="text-white">Packages</li>
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

    @include('homepage.add-earn-chat')

    @include('homepage.footer')