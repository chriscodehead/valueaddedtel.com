@push('modals')
    <div class="modal fade" tabindex="-1" id="{{$id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit {{$package->package_name}}</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">

                    <form action="{{route('admin.packages.update', [
                            'packagePlan' => $package->id
                        ])}}" method="POST" class="form-validate is-alter">
                        @csrf

                        <div class="form-group">
                            <label class="form-label" for="amount">Package Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg"  name="package_name" placeholder="Package Name" value="{{$package->package_name}}" required>
                            </div>
                        </div>

                        <div class="row row-cols-2 g-3">
                            <div class="form-group">
                                <label class="form-label" for="reg_fee">Registration Fee</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control form-control-lg" id="reg_fee" name="reg_fee" value="{{$package->reg_fee}}" placeholder="Registration Fee" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="reg_bonus">Registration Bonus</label>
                                <div class="form-control-wrap">
                                    <input type="number" class="form-control form-control-lg" id="reg_bonus" name="reg_bonus" value="{{$package->reg_bonus}}" placeholder="Registration Bonus" required>
                                </div>
                            </div>
                        </div>

                        <div class="row row-cols-2 g-3">
                        <div class="form-group">
                            <label class="form-label" for="level_commission">Level Commission</label>
                            <div class="form-control-wrap">
                                <input type="number" class="form-control form-control-lg" id="level_commission" name="level_commission" value="{{$package->level_commission}}" placeholder="Level Commission" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="point_value">Point Value</label>
                            <div class="form-control-wrap">
                                <input type="number" class="form-control form-control-lg" id="point_value" name="point_value" value="{{$package->point_value}}" placeholder="Point Value" required>
                            </div>
                        </div>
                    </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush
