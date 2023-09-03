<?php $page = 'Login' ?>
@include('auth.head')

<body id="kt_body" class="app-blank app-blank">
    <!-- <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript> -->
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
                        <form class="form w-100" novalidate="novalidate" action="{{route('do-login')}}" method="POST">
                            @csrf
                            <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">Welcome, Please Login account</h1>
                            </div>
                            <div class="fv-row mb-8">
                                <label for="">Enter Username</label>
                                <input type="text" placeholder="Username" name="username" class="form-control bg-transparent" />
                            </div>
                            <div class="fv-row mb-8" data-kt-password-meter="true">
                                <div class="mb-1">
                                    <div class="position-relative mb-3">
                                        <input class="form-control bg-transparent" type="password" placeholder="Password" name="password" />
                                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                            <i class="bi bi-eye-slash fs-2"></i>
                                            <i class="bi bi-eye fs-2 d-none"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                                    <span class="indicator-label">Login</span>
                                </button>
                            </div>
                            <div class="text-gray-500 text-center fw-semibold fs-6">Don't have an Account?
                                <a href="{{route('register')}}" class="link-primary fw-semibold">Sign Up</a>
                            </div>
                            <div class="text-gray-500 text-center fw-semibold fs-6">
                                <a href="{{route('forgot-password')}}" class="link-primary fw-bold">Forgot Password?</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!--end::Form-->
            @include('auth.footer')