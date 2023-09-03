<x-user-layout :user="$user" :selectedUser="$selectedUser">
    <div>

        <h5 class="title">Update Profile</h5>
        
          	<form action="{{route('admin.users.update-profile', ['user' => $selectedUser->username])}}" method="POST" >
                @csrf
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="full-name">First Name</label>
                            <input type="text" class="form-control form-control-lg" id="full-name" name="firstname" value="{{$selectedUser['firstname']}}" placeholder="Enter Full name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="full-name">Last Name</label>
                            <input type="text" class="form-control form-control-lg" id="full-name" name="lastname" value="{{$selectedUser['lastname']}}" placeholder="Enter Full name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="display-name">Username</label>
                            <input type="text" class="form-control form-control-lg" id="display-name" name="username" value="{{$selectedUser['username']}}" placeholder="Enter display name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="phone-no">Email</label>
                            <input type="email" class="form-control form-control-lg" id="phone-no" name="email" value="{{$selectedUser['email']}}" placeholder="Email address">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="phone-no">Phone Number</label>
                            <input type="text" class="form-control form-control-lg" id="phone-no" name="phone" value="{{$selectedUser['phone']}}" placeholder="Phone Number">
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
            </form>
          <hr/>
		
      	<h5 class="title">Update Password</h5>
        
      <form  action="{{route('update-password')}}" method="POST" >
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
            </form>
			
      		<hr/>
      
      <h5 class="title">Update Bank Account</h5>
        
            
      		<form  action="{{route('admin.users.update-bank', ['user' => $selectedUser->username])}}" method="POST" >
                @csrf
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="address-l1">Account Number</label>
                            <input type="number" class="form-control form-control-lg" name="account_number" value="{{$selectedUser['account_number']}}" id="address-l1">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="address-l2">Bank</label>
                            <select name="bank_code"  class="form-control form-control-lg" id="">
                                <option value="">Select Bank</option>
                                @foreach($allBanks as $item)
                                    <option @selected($selectedUser->bank_name == $item->bank_name) value="{{$item->bank_code}}">{{$item->bank_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="address-st">Account Name</label>
                            <input type="text" class="form-control form-control-lg" name="account_name" value="{{$selectedUser['account_name']}}" id="address-st">
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
            </form>
			
      		<hr/>
            <h5 class="title">Update Pin</h5>
        
      		<form  action="{{route('admin-update-pin', ['user' => $selectedUser->username])}}" method="POST" >
                @csrf
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="address-l1">New PIN</label>
                            <input type="password" minlength="4" maxlength="4" pattern="[0-9]{4}" id="pin" class="form-control form-control-lg" name="pin" id="address-l1">
                        	@error('pin') 
                          <small class="text-danger">{{$message}}</small>
                          	@enderror
                      	</div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="address-l1">Confirm New PIN</label>
                            <input type="password" minlength="4" maxlength="4" pattern="[0-9]{4}" id="pin" class="form-control form-control-lg" name="pin_confirmation" id="address-l1">
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
            </form>
    </div>
</x-user-layout>