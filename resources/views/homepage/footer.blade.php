<?php
$siteFacebook = config('constants.site.siteFacebook');
$siteTwitter = config('constants.site.siteTwitter');
$siteInstagram = config('constants.site.siteInstagram');
$siteAddress = config('constants.site.siteAddress');
$siteEmail = config('constants.site.siteEmail');
$sitePhone = config('constants.site.sitePhone');
?>

<footer class="footer-area pt-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6">
                <!--data-aos="fade-up" data-aos-delay="50" data-aos-duration="500" data-aos-once="true"-->
                <div class="single-footer-widget" >
                    <div class="widget-logo">
                        <img width="150" src="home-img/logo-main.png" class="black-logo" alt="image">
                    </div>
                    <p style="font-size:12px;"><?php print $siteName; ?> is a Limited Liability company registered with the Corporate Affair Commission since 2017 and also NCC License on sale and distribution of online data, Airtime etc across mobile network in Nigeria.</p>
                    <ul class="widget-social">
                        <li>
                            <a href="<?php print $siteFacebook; ?>" target="_blank">
                                <i class="ri-facebook-fill"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php print $siteTwitter; ?>" target="_blank">
                                <i class="ri-twitter-fill"></i>
                            </a>
                        </li>
                        <li>
                            <a href="<?php print $siteInstagram; ?>" target="_blank">
                                <i class="ri-instagram-line"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <!--data-aos="fade-up" data-aos-delay="60" data-aos-duration="600" data-aos-once="true"-->
                <div class="single-footer-widget ps-5" >
                    <h3>Earn with us</h3>
                    <ul class="quick-links">
                        <li><a href="how-it-works">Affiliates And Partnerships</a></li>
                        <li><a href="incentives">Incentives</a></li>
                        <li><a href="packages">Packages</a></li>
                        <li><a href="terms">Terms & Conditions</a></li>
                        <!-- <li><a href="help">Help/Support</a></li> -->
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <!--data-aos="fade-up" data-aos-delay="70" data-aos-duration="700" data-aos-once="true"-->
                <div class="single-footer-widget ps-5" >
                    <h3>Resources</h3>
                    <ul class="quick-links">
                        <li><a href="about-us">About Us</a></li>
                        <li><a href="faq">FAQ's</a></li>
                        <!-- <li><a href="services">Services</a></li> -->
                        <li><a href="privacy-policy">Privacy Policy</a></li>
                        <li><a href="contact">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <!--data-aos="fade-up" data-aos-delay="80" data-aos-duration="800" data-aos-once="true"-->
                <div class="single-footer-widget" >
                    <h3>Contact Info</h3>
                    <ul class="info-links">
                        <li><span>Location:</span> <?php print $siteAddress; ?></li>
                        <li><span>Email:</span> <a href="mailto:<?php print $siteEmail; ?>"><span class="__cf_email__"><?php print $siteEmail; ?></span></a></li>
                        <li><span>Phone:</span> <a href="tel:<?php print $sitePhone; ?>"><?php print $sitePhone; ?></a></li>
                        <!-- <li><span>Fax:</span> <a href="tel:1212-9876543">+1-212-9876543</a></li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="copyright-area-content">
                <p>
                    Copyright @<script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                    <script>
                        document.write(new Date().getFullYear())
                    </script> <?php print $siteName; ?> All Rights Reserved
                </p>
            </div>
        </div>
    </div>
</footer>


<div class="go-top">
    <i class="ri-arrow-up-s-line"></i>
</div>
<script src="home-assets/js/jquery.min.js"></script>
<script src="home-assets/js/bootstrap.bundle.min.js"></script>
<script src="home-assets/js/jquery.meanmenu.js"></script>
<script src="home-assets/js/owl.carousel.min.js"></script>
<script src="home-assets/js/jquery.appear.js"></script>
<script src="home-assets/js/odometer.min.js"></script>
<script src="home-assets/js/jquery.magnific-popup.min.js"></script>
<script src="home-assets/js/TweenMax.min.js"></script>
<script src="home-assets/js/ScrollMagic.min.js"></script>
<script src="home-assets/js/aos.js"></script>
<script src="home-assets/js/jquery.ajaxchimp.min.js"></script>
<script src="home-assets/js/form-validator.min.js"></script>
<script src="home-assets/js/contact-form-script.js"></script>
<script src="home-assets/js/wow.min.js"></script>
<script src="home-assets/js/main.js"></script>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
        }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>

</body>
</html>