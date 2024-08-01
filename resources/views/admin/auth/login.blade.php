<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <title>Metronic - the world's #1 selling Bootstrap Admin Theme Ecosystem for HTML, Vue, React, Angular &amp; Laravel
        by Keenthemes</title>
    <meta charset="utf-8" />
    <meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="shortcut icon" href="{{asset('admin/media/logos/favicon.ico')}}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    @include('admin.layouts.style')
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="bg-body">
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <div class="d-flex flex-column flex-root">
                <!--begin::Authentication - Sign-in -->
                <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                    <!--begin::Aside-->
                    <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #F2C98A">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                            <!--begin::Content-->
                            <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                                <!--begin::Logo-->
                                <a href="" class="py-9 mb-5">
                                    <img alt="Logo" src="{{asset('admin/media/logo.svg')}}" class="h-60px" />
                                </a>
                                <!--end::Logo-->
                                <!--begin::Title-->
                                <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">Welcome to Metronic</h1>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <p class="fw-bold fs-2" style="color: #986923;">Discover Amazing Metronic
                                    <br />with great build tools
                                </p>
                                <!--end::Description-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Aside-->
                    <!--begin::Body-->
                    <div class="d-flex flex-column flex-lg-row-fluid py-10">
                        <!--begin::Content-->
                        <div class="d-flex flex-center flex-column flex-column-fluid">
                            <!--begin::Wrapper-->
                            <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                                <!--begin::Form-->
                                <form class="form w-100" novalidate="novalidate" method="post" id="kt_sign_in_form" action="{{route('admin.login')}}">
                                    @csrf
                                    <!--begin::Heading-->
                                    <div class="text-center mb-10">
                                        <!--begin::Title-->
                                        <h1 class="text-dark mb-3">Sign In to Metronic admin</h1>
                                        <!--end::Title-->
                                    </div>
                                    <!--begin::Heading-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input required class="form-control" type="text" name="email" autocomplete="off" />
                                        <!--end::Input-->
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack mb-2">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                            <!--end::Label-->
                                            <!--begin::Link-->
                                            <a href="" class="link-primary fs-6 fw-bolder">Forgot Password ?</a>
                                            <!--end::Link-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Input-->
                                        <input required class="form-control" type="password" name="password" autocomplete="off" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="text-center">
                                        <!--begin::Submit button-->
                                        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                            <span class="indicator-label">Continue</span>
                                        </button>
                                        <!--end::Submit button-->
                                    </div>
                                    <!--end::Actions-->
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Authentication - Sign-in-->
            </div>
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
    </div>
</body>
<!--end::Body-->
@include('admin.layouts.script')
@stack('custom-scripts')

</html>