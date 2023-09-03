<?php
$siteName = config('constants.site.siteName');
$title = 'Our Incentive | ' . $siteName;
$description = '';
$keyword = '';
?>
@include('homepage.head')

<body>

    @include('homepage.header2')

    <div class="page-banner-area" style="background-image:url(home-img/group-friends-playing-relaxing-swimming-pool-during-summer-holidays.jpg); background-repeat: none; background-size: cover; background-position: center;">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <div class="page-banner-content" data-aos="fade-right" data-aos-delay="50" data-aos-duration="500" data-aos-once="true">
                        <h2 class="text-white">Our Incentive</h2>
                        <ul>
                            <li>
                                <a href="./">Home</a>
                            </li>
                            <li class="text-white">Incentive</li>
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




    <div class="compare-pricing-area pb-100 pt-100 ">
        <div class="container">
            <div class="section-title">
                <span>INCENTIVES</span>
                <h2>Earn easy by partnering with us.</h2>
            </div>
            <div class="compare-pricing-table table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-info">
                            <th scope="col"><b>S/N</b></th>
                            <th class="bg-2A3F65 text-white"><b>Incentives</b></th>
                            <th scope="col"><b>Cash Price</b> </th>
                            <th scope="col"><b>Criteria(Points)</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-F7F7F7">
                            <td>A</td>
                            <td class="bg-2A3F65">Monthly Leadership Bonus (For VIP and Ambassador Class)</td>
                            <td class="text-center"> ₦80,000 </td>
                            <td class="text-center">Generate 10,000PV in a month</td>
                        </tr>
                        <tr>
                            <td>B</td>
                            <td class="bg-2A3F65">Local Trip Fund</td>
                            <td class="text-center color-009286">₦500,000</td>
                            <td class="text-center color-009286">Accumulate 25,000PV</td>
                        </tr>
                        <tr class="bg-F7F7F7">
                            <td>C</td>
                            <td class="bg-2A3F65">International Trip Fund</td>
                            <td class="text-center color-5D7079">₦1,500,000</td>
                            <td class="text-center color-5D7079">Accumulate 60,000PV</td>
                        </tr>
                        <tr>
                            <td>D</td>
                            <td class="bg-2A3F65">Car Fund </td>
                            <td class="text-center color-90006F">₦3,500,000</td>
                            <td class="text-center color-90006F">Accumulate 100,000PV</td>
                        </tr>
                        <tr>
                            <td>E</td>
                            <td class="bg-2A3F65">House Fund </td>
                            <td class="text-center color-90006F">₦5,000,000 </td>
                            <td class="text-center color-90006F">Accumulate 250,000PV</td>
                        </tr>
                        <tr>
                            <td>F</td>
                            <td class="bg-2A3F65">SUV Fund</td>
                            <td class="text-center color-90006F">₦6,000,000 </td>
                            <td class="text-center color-90006F">Accumulate 500,000PV</td>
                        </tr>
                        <tr>
                            <td>G</td>
                            <td class="bg-2A3F65">3 Bedroom Bungalow</td>
                            <td class="text-center color-90006F">₦8,000,000 </td>
                            <td class="text-center color-90006F">Accumulate 1,000,000PV</td>
                        </tr>
                        <tr>
                            <td>H</td>
                            <td class="bg-2A3F65">Products</td>
                            <td class="text-center color-90006F">₦(Profit Sharing) </td>
                            <td class="text-center color-90006F">Accumulate 2,000,000PV</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <ul>
                                    <li>NOTE: First and Foremost note that points are important that none can or should be wipe out.</li>
                                    <li>That 10,000pv is a monthly target thing that anyone that achieves it is guaranteed month salary.</li>
                                    <li>For example if in September Mr. John PV was 18,000 he is qualified for the monthly bonus but note that<br> doesn't stop is total cumulative of 18000 or other PV he must have accumulated over time. <br>The essence of the monthly target is to ginger people to act!</li>

                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    <div class="compare-pricing-area pb-100 pt-25 ">
        <div class="container">
            <div class="section-title">
                <h2>INCENTIVES REWARDS FOR PV ANALYSIS</h2>
            </div>
            <div class="compare-pricing-table table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-info">
                            <th scope="col"><b>Package</b></th>
                            <th scope="col" class="bg-2A3F65 text-white"><b>PV</b></th>
                            <th scope="col"><b>Level of PV</b> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-F7F7F7">
                            <td>O level Class </td>
                            <td class="bg-2A3F65">2</td>
                            <td>N/A </td>
                        </tr>
                        <tr>
                            <td>Pre Degree Class </td>
                            <td class="bg-2A3F65">5</td>
                            <td>N/A </td>
                        </tr>
                        <tr class="bg-F7F7F7">
                            <td>Pass Class </td>
                            <td class="bg-2A3F65">10</td>
                            <td>5 </td>
                        </tr>
                        <tr>
                            <td>3rd Class </td>
                            <td class="bg-2A3F65">20</td>
                            <td>6 </td>
                        </tr>
                        <tr>
                            <td>2nd Class </td>
                            <td class="bg-2A3F65">40</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td>1st Class </td>
                            <td class="bg-2A3F65">60</td>
                            <td>8</td>
                        </tr>
                        <tr>
                            <td>Business Class </td>
                            <td class="bg-2A3F65">80</td>
                            <td>9</td>
                        </tr>
                        <tr>
                            <td>VIP Class </td>
                            <td class="bg-2A3F65">100</td>
                            <td>10</td>
                        </tr>
                        <tr>
                            <td>Ambassador Class </td>
                            <td class="bg-2A3F65">200</td>
                            <td>10</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    @include('homepage.footer')