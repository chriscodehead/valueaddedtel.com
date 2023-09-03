<?php
require_once('lib.php');
$title = 'Frequently Questions | '.$siteName;
$description = '';
$keyword = '';
require_once('head.php');?>

<body>

    <?php require_once('header2.php');?>


<div class="page-banner-area">
 <div class="container">
  <div class="row align-items-center justify-content-center">
   <div class="col-lg-6 col-md-6">
   <div class="page-banner-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
   <h2>Frequently Questions</h2>
   <ul>
   <li>
   <a href="./">Home</a>
   </li>
    <li>FAQ</li>
   </ul>
   </div>
   </div>
   <div class="col-lg-6 col-md-6">
   <div class="page-banner-image" data-aos="fade-left" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
   <img src="assets/images/page-banner/banner.png" alt="image">
   <div class="banner-shape">
   <img src="assets/images/page-banner/shape.png" alt="image">
   </div>
   </div>
   </div>
  </div>
 </div>
</div>


<div class="faq-area ptb-100">
<div class="container">
<div class="section-title">
<span>Frequently Ask Questions</span>
<h2>Let’s Answer Some Of Your Questions Or Frequently Asked Questions</h2>
</div>
<div class="row align-items-center">

<div class="col-lg-6 col-md-12">
<div class="faq-accordion mb-25">
<div class="accordion" id="FaqAccordion">

<div class="accordion-item">
<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
 What is the name of the company?
</button>
<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#FaqAccordion">
<div class="accordion-body">
<p><?php print $siteName;?>.</p>
</div>
</div>
</div>

<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
What is the name of your CEO?
</button>
<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#FaqAccordion">
<div class="accordion-body">
<p>HON. GODSWILL ANUHWIN.</p>
</div>
</div>
</div>

<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
When was the company founded? 
</button>
<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#FaqAccordion">
<div class="accordion-body">
<p>2017.</p>
</div>
</div>
</div>


<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
What are your Products/Services? 
</button>
<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#FaqAccordion">
<div class="accordion-body">
<p>VTU for Airtime, Data, Cable TV Subscription and Electricity Bills Payments - PHCN, Internet Subscription, Recharge cards E-PIN printing Platform.</p>
</div>
</div>
</div>


<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
Do you have an office in Nigeria? 
</button>
<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#FaqAccordion">
<div class="accordion-body">
<p>Yes, <?php print $siteAddress;?>.</p>
</div>
</div>
</div>


<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
Is the company registered with CAC? 
</button>
<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#FaqAccordion">
<div class="accordion-body">
<p>Yes, RC: <?php print $siteCAC;?> verified by FIRS and Licenced by NCC: <?php print $siteNCC;?>.</p>
</div>
</div>
</div>


<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
Are you sure this company won't fold? 
</button>
<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#FaqAccordion">
<div class="accordion-body">
<p>Very sure because as long as we have human usage of Smartphone we will always need these VTU products and <?php print $siteName;?> has a realistic compensation plan.</p>
</div>
</div>
</div>


<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
How do I join your company?
</button>
<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#FaqAccordion">
<div class="accordion-body">
<p>Get a Referral ID from who told you about the company and signup.</p>
</div>
</div>
</div>


<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
How much is Registration?
</button>
<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#FaqAccordion">
<div class="accordion-body">
<p>FREE but not active yet for business untill you activate to any package.</p>
</div>
</div>
</div>


<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
So how much is Activation? 
</button>
<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#FaqAccordion">
<div class="accordion-body">
<p>Between N1000 - N100,000, depending on how much you want to earn.</p>
</div>
</div>
</div>


<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
Must I refer before I start making money? 
</button>
<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#FaqAccordion">
<div class="accordion-body">
<p>NO, you can make money from your personal usage of the products and distributing VTU products to others.</p>
</div>
</div>
</div>


<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
Getting people is hard, how do I go about it? 
</button>
<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#FaqAccordion">
<div class="accordion-body">
<p>Use digital marketing skills and ask your upline for help.</p>
</div>
</div>
</div>


<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
Is the Company License?
</button>
<div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#FaqAccordion">
<div class="accordion-body">
<p>Yes. <?php print $siteName;?> NCC LICENSE with a Class License Number... CL/S&I/026/22</p>
</div>
</div>
</div>


 

</div>
</div>
</div>

<div class="col-lg-6 col-md-12">
<div class="faq-accordion">
<div class="accordion" id="FaqAccordionTwo">

<div class="accordion-item">
<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
Why should I target leaders to train me?
</button>
<div id="collapseFour" class="accordion-collapse collapse show" data-bs-parent="#FaqAccordionTwo">
<div class="accordion-body">
<p>They have the business secret and make your journey easier.</p>
</div>
</div>
</div>

<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
You said referring people is very good, HOW please?
</button>
<div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#FaqAccordionTwo">
<div class="accordion-body">
<p>You earn 25% and PV. Access INCENTIVE AWARDS 500K - 10.0M for referral and indirect VTU bonus 0.10% are available to those who refer others.</p>
</div>
</div>
</div>

<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
What is PV?
</button>
<div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#FaqAccordionTwo">
<div class="accordion-body">
<p>It called POINT VALUE. PV grows as you connect others to your own VTU portal daily.</p>
</div>
</div>
</div>



<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
How many people am I expected to directly refer?
</button>
<div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#FaqAccordionTwo">
<div class="accordion-body">
<p>No LIMIT.</p>
</div>
</div>
</div>



<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
Do I need Multiple Account?
</button>
<div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#FaqAccordionTwo">
<div class="accordion-body">
<p>NOT necessary again you can register as many as you can on your single Account.</p>
</div>
</div>
</div>



<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
What about 40:40:20 RULE?
</button>
<div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#FaqAccordionTwo">
<div class="accordion-body">
<p>(ABOLISHED) except to earn monthly 100k for 10,000PV.</p>
</div>
</div>
</div>



<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
How then can I help my downlines?
</button>
<div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#FaqAccordionTwo">
<div class="accordion-body">
<p>You can choose to use their usernames to signup people and hold presentation for them.</p>
</div>
</div>
</div>



<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
Is the VTU & E-PIN for all networks?
</button>
<div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#FaqAccordionTwo">
<div class="accordion-body">
<p>YES it is for MTN, GLO, AIRTEL & 9mobile.</p>
</div>
</div>
</div>



<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
 How do I sell this VTU?
</button>
<div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#FaqAccordionTwo">
<div class="accordion-body">
<p>From the <?php print $siteName;?> Customized VTU E-Wallet.</p>
</div>
</div>
</div>



<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
The monies in my E-Wallet, how do I get it as cash to spend?
</button>
<div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#FaqAccordionTwo">
<div class="accordion-body">
<p>You can transfer to your bank everyday, sell to other Xtrarvalue Added distributors who need E-Wallet funding.</p>
</div>
</div>
</div>



<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
Am I going to get all my Activation fees back to buy VTU product after Activation?
</button>
<div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#FaqAccordionTwo">
<div class="accordion-body">
<p>No, the company only pay you 10% of your Activation fee as welcome bonus. The Activation is used to open online store for you which would have cost you about N5M if not for Xtrarvalue Added VTU franchise.</p>
</div>
</div>
</div>



<div class="accordion-item">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
Is there a renewal fees in <?php print $siteName;?>?
</button>
<div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#FaqAccordionTwo">
<div class="accordion-body">
<p>Not at all.</p>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>


<?php require_once('cert.php');?>


 <?php require_once('footer.php');?>