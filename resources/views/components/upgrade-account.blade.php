@auth
    @if (auth()->user()->plan->reg_fee <= 0)
        <div class="mb-5">
            <div class="alert alert-warning ">
                <!-- <em class="icon ni ni-alert-circle"></em>  -->
                <div class="d-md-flex justify-content-between align-item-center">
                    <div class="flex-fill">
                        <h5 >🔔 Unlock all our Services and Exclusive Benefits!</h5>
                        <p class="fs-4">
                            Don't miss out on the full potential of our platform. Click here to upgrade and access everything we have to offer!
                        </p>
                    </div>

                    <a href="{{route('upgrade')}}" class="btn btn-warning mt-3 mt-md-0">Upgrade Account</a>
                </div>
            </div>
        </div>
    @endif
@endauth