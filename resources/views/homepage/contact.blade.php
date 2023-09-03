<?php
$siteName = config('constants.site.siteName');
$siteAddress = config('constants.site.siteAddress');
$siteEmail = config('constants.site.siteEmail');
$siteEmail2 = config('constants.site.siteEmail2');
$title = 'Contact Us | ' . $siteName;
$description = '';
$keyword = '';
?>

@include('homepage.head')

<body>

    @include('homepage.header2')

    <div class="page-banner-area" style="background-image:url(home-img/contact-helpdesk-customer-service-spaceship-graphic-concept.jpg); background-repeat: none; background-size: cover; background-position: center;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <div class="page-banner-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                        <h2 class="text-white">Contact Us</h2>
                        <ul>
                            <li>
                                <a href="./">Home</a>
                            </li>
                            <li class="text-white">Contact</li>
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


    <div class="contact-information-area pt-100 pb-75">
        <div class="container">
            <div class="section-title">
                <span>Contact Information</span>
                <h2>We're More Than International Payments, Get In Touch</h2>
            </div>
            <div class="row justify-content-center">

                <div class="col-lg-4 col-md-6">
                    <div class="contact-information-card">
                        <div class="icon">
                            <i class="ri-map-pin-line"></i>
                        </div>
                        <h3>Address:</h3>
                        <p><?php print $siteAddress; ?></p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="contact-information-card">
                        <div class="icon">
                            <i class="ri-mail-line"></i>
                        </div>
                        <h3>Email Address:</h3>
                        <p><a href="mailto:<?php print $siteEmail; ?>"><span><?php print $siteEmail; ?></span></a>
                            <a href="mailto:<?php print $siteEmail2; ?>"><span><?php print $siteEmail2; ?></span></a>
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="contact-information-card">
                        <div class="icon">
                            <i class="ri-phone-line"></i>
                        </div>
                        <h3>Phone Number:</h3>
                        <p style="text-align: left;">
                            • Customer Service : 09114986547<br>
                            • Office Admin | Accountant : 07019020562<br>
                            • HoD Telecom | Compliance : 09011244966<br>
                            • General Admin | Payment | Incentives : 08037610045
                        </p>
                    </div>
                </div>



            </div>
        </div>
    </div>


    <div class="contact-area ptb-100">
        <div class="container">
            <div class="section-title">
                <span>Contact Information</span>
                <h2>Fill In Your Information And We'll Be In Touch As Soon As We Can</h2>
            </div>
            <form id="contactForm">
                <div class="row">

                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>Your Name *</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Eg: Thomas Adison" required data-error="Please enter your name">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="example@snuff.com" required data-error="Please enter your email">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>Phone *</label>
                            <input type="text" name="phone_number" id="phone_number" placeholder="Enter your phone number" required data-error="Please enter your number" class="form-control">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="form-group">
                            <label>Subject *</label>
                            <input type="text" name="msg_subject" id="msg_subject" placeholder="Enter your subject" class="form-control" required data-error="Please enter your subject">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label>Your Message</label>
                            <textarea name="message" class="form-control" id="message" placeholder="Type your message" cols="30" rows="6" required data-error="Write your message"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <div class="form-check">
                                <input name="gridCheck" value="I agree to the terms and privacy policy." class="form-check-input" type="checkbox" id="gridCheck" required>
                                <label class="form-check-label" for="gridCheck">
                                    I agree to the <a href="terms-of-service.html">terms</a> and <a href="privacy-policy.html">privacy policy</a>
                                </label>
                                <div class="help-block with-errors gridCheck-error"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <div class="send-btn">
                            <button type="submit" class="default-btn">Submit Now</button>
                        </div>
                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                        <div class="clearfix"></div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    @include('homepage.footer')