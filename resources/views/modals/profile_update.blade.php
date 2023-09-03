<!-- @@ Profile Edit Modal @e -->
<div class="modal fade" tabindex="-1" role="dialog" id="profile-edit">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-lg">
                <h5 class="title">Update Profile</h5>
                <ul class="nk-nav nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#personal">Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#password">Password</a>
                    </li>
                    @if (!$user->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#bank">Bank Info</a>
                        </li>
                    @endif
                    @if($user['pin'])
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#updatepin">Transaction PIN</a>
                    </li>
                    @endif
                </ul><!-- .nav-tabs -->
                <div class="tab-content">
                    <form class="tab-pane active" action="{{route('update-profile')}}" method="POST" id="personal">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="full-name">First Name</label>
                                    <input type="text" class="form-control form-control-lg" id="full-name" name="firstname" value="{{$user['firstname']}}" placeholder="Enter Full name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="full-name">Last Name</label>
                                    <input type="text" class="form-control form-control-lg" id="full-name" name="lastname" value="{{$user['lastname']}}" placeholder="Enter Full name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="display-name">Username</label>
                                    <input type="text" class="form-control form-control-lg" id="display-name" name="username" value="{{$user['username']}}" placeholder="Enter display name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="phone-no">Email</label>
                                    <input type="email" class="form-control form-control-lg" id="phone-no" name="email" value="{{$user['email']}}" placeholder="Email address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="phone-no">Phone Number</label>
                                    <input type="text" class="form-control form-control-lg" id="phone-no" name="phone" value="{{$user['phone']}}" placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button type="submit" class="btn btn-lg btn-primary">Update Profile</button>
                                    </li>
                                    <li>
                                        <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form><!-- .tab-pane -->
                    <form class="tab-pane" action="{{route('update-password')}}" method="POST" id="password">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="address-l1">Old Password</label>
                                    <input type="password" class="form-control form-control-lg" name="old_password" id="address-l1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="address-l2">New Password</label>
                                    <input type="password" class="form-control form-control-lg" name="password" id="address-l2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="address-st">Confirm Password</label>
                                    <input type="password" class="form-control form-control-lg" name="password_confirmation" id="address-st">
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button type="submit" class="btn btn-lg btn-primary">Update Password</button>
                                    </li>
                                    <li>
                                        <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form><!-- .tab-pane -->
                    @if (!$user->is_admin)
                        <form class="tab-pane" action="{{route('update-bank')}}" method="POST" id="bank">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-l1">Account Number</label>
                                        <input type="number" class="form-control form-control-lg" name="account_number" value="{{$user['account_number']}}" id="address-l1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-l2">Bank</label>
                                        <select name="bank_code" class="form-control form-control-lg" id="">
                                            <option value="">Select Bank</option>
                                            @foreach($allBanks as $item)
                                                <option value="{{$item->bank_code}}">{{$item->bank_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="address-st">Account Name</label>
                                        <input type="text" class="form-control form-control-lg" name="account_name" value="{{$user['account_name']}}" id="address-st">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                        <li>
                                            <button type="submit" class="btn btn-lg btn-primary">Update Bank</button>
                                        </li>
                                        <li>
                                            <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form><!-- .tab-pane -->
                    @endif
                    @if($user['pin'])
                    <form class="tab-pane" action="{{route('update-pin')}}" method="POST" id="updatepin">
                        @csrf
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="address-l1">Enter Old PIN</label>
                                    <input type="password" minlength="4" maxlength="4" pattern="[0-9]{4}" id="pin" class="form-control form-control-lg" name="old_pin">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="address-l1">New PIN</label>
                                    <input type="password" minlength="4" maxlength="4" pattern="[0-9]{4}" id="pin" class="form-control form-control-lg" name="pin" id="address-l1">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="address-l1">Confirm New PIN</label>
                                    <input type="password" minlength="4" maxlength="4" pattern="[0-9]{4}" id="pin" class="form-control form-control-lg" name="confirm_pin" id="address-l1">
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button type="submit" class="btn btn-lg btn-primary">Change PIN</button>
                                    </li>
                                    <li>
                                        <a href="#" data-dismiss="modal" class="link link-light">Cancel</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form><!-- .tab-pane -->
                    @endif($user['pin'])
                </div><!-- .tab-content -->
            </div><!-- .modal-body -->
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
</div><!-- .modal -->