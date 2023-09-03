<div class="compare-pricing-area pb-100 pt-100 ">
        <div class="container">
            <div class="section-title">
                <span>Membership Package</span>
                <h2>Earn easy by partnering with us.</h2>
            </div>
            <div class="compare-pricing-table table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-info">
                            <th scope="col"><b>Membership Package</b></th>
                            <th scope="col" class="bg-2A3F65 text-white"><b>Registration Fee (?)</b></th>
                            <th scope="col"><b>Registration Bonus (?)</b> </th>
                            <th scope="col"><b>Levels of Commission</b></th>
                            <th scope="col"><b>Qty of PV (Point Value)</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (\App\Models\PackagePlan::all() as $plan)
                            <tr class="bg-F7F7F7">
                                <td>{{$plan->package_name}}</td>
                                <td class="bg-2A3F65 text-center"><x-naira/>{{number_format($plan->reg_fee)}}</td>
                                <td class="text-center"><x-naira/>{{number_format($plan->reg_bonus)}} </td>
                                <td class="text-center">{{$plan->level_commission}}</td>
                                <td class="text-center">{{$plan->point_value}}</td>
                            </tr>
                        @empty
                            
                        @endforelse
                        
                        <tr>
                            <td colspan="5">
                                <ul>
                                    <li>Up-grade your package as you earn until you’re on the highest plan to enable you
                                        enjoy commission payout to the maximum level.</li>
                                    <li>You are given an instant registration bonus which you can use to do any
                                        transaction until you start to fund your wallet or earn more bonuses.</li>
                                    <li>You also Earn 25% direct referral bonus and 5 – 1% indirect referral bonus for
                                        all package registration and upgrades.</li>
                                    <li>No experience needed, no targets, no monthly fees, no renewal, you do not need
                                        to quit your job. You do this at your own pace in your spare time.</li>
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
                <h2>LEVEL COMMISSION</h2>
            </div>
            <div class="compare-pricing-table table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="bg-info">
                            <th scope="col"><b>LEVEL</b></th>
                            <th scope="col" class="bg-2A3F65 text-white"><b>Percentage Referral Commission</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (\App\Models\LevelCommission::all() as $comission)
                            <tr class="bg-F7F7F7">
                                <td>{{$comission->name}} </td>
                                <td class="bg-2A3F65">{{$comission->referral_comm}}</td>
                            </tr>
                        @empty
                        @endforelse
                        <!-- <tr>
                            <td>2nd </td>
                            <td class="bg-2A3F65">5%</td>
                        </tr>
                        <tr class="bg-F7F7F7">
                            <td>3rd  </td>
                            <td class="bg-2A3F65">2.5%</td>
                        </tr>
                        <tr>
                            <td>4th  </td>
                            <td class="bg-2A3F65">1.5%</td>
                        </tr>
                        <tr>
                            <td>5th – 10th  </td>
                            <td class="bg-2A3F65">1%</td>
                        </tr> -->
                    </tbody>
                </table>

            </div>
        </div>
    </div>


    