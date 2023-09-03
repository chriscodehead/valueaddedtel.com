<?php $page = 'Verify Email' ?>
@include('auth.head')

<body id="kt_body" class="app-blank app-blank">
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center" style="background-image: url(../../../auth/assets/media/misc/auth-bg.png)">
                <div class="d-flex flex-column flex-center p-6 p-lg-10 w-100">
                    <a href="/" class="mb-0 mb-lg-5">
                        <img alt="Logo" src="home-img/logo-main.png" class="h-40px h-lg-50px" />
                    </a>
                    <img class="d-none d-lg-block mx-auto w-300px w-lg-75 w-xl-500px mb-10 mb-lg-20" src="home-img/recharg-phone-45.png" alt="" />
                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bold text-center mb-7">A Better Way To Pay Bills With <br> Ease and Earn Extra Cash</h1>
                </div>
            </div>
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10">
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <div class="w-lg-500px p-10">
                        <form class="form w-100" novalidate="novalidate" action="{{route('do-verify')}}" method="POST">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">Verify Email Address</h1>
                            </div>
                            <div class="fv-row mb-8">
                                <label for="">Email address</label>
                                <input type="email" placeholder="Enter Code" name="email" value="{{$email}}" class="form-control bg-transparent" readonly />
                            </div>
                            <div class="fv-row mb-8">
                                <label for="">Enter Code</label>
                                <input type="number" placeholder="Enter Code" name="code" class="form-control bg-transparent" />
                            </div>
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                                    <span class="indicator-label">Verify Email</span>
                                </button>
                            </div>
                            <div class="text-gray-500 text-center fw-semibold fs-6 mb-3">
                                Did not recieve an email
                                <a href="{{route('verify-email.resend')}}" class="link-primary fw-semibold">Resend</a>
                            </div>
                            <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
                                <a href="{{route('login')}}" class="link-primary fw-semibold">Sign in</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!--end::Form-->
                @include('auth.footer')