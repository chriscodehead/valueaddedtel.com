@push('modals')
    <div class="modal fade" tabindex="-1" id="virtual-account">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create a Virtual Account</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">

                    <form action="{{route('bvn.request')}}" method="POST" class="form-validate is-alter">
                        @csrf

                        <div class="form-group">
                            <label class="form-label" for="bvn">Your BVN Number</label>
                            <div class="form-control-wrap">
                                <input type="text" autocomplete="off" class="form-control form-control-lg"  name="bvn" placeholder="BVN Number." required>
                                @error('bvn')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="dateOfBirth">Date of Birth</label>
                            <div class="form-control-wrap">
                                <input type="date" class="form-control form-control-lg" name="dateOfBirth" placeholder="Registration Fee" required>
                                @error('dateOfBirth')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary">Create Virtual Account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush
