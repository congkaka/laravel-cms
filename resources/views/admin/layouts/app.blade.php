<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <meta name="description"
          content="Unlockmega">
    <meta property="og:title" content="Unlockmega">
    <meta property="og:description"
          content="Unlockmega">
    <base href="{{asset('')}}">
    <meta charset="utf-8"/>
    <link rel="shortcut icon" href="{{asset('admin/media/favicon.ico')}}"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    @include('admin.layouts.style')
    @stack('custom-css')
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed"
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            @include('admin.layouts.menu')
            <!--end::Aside-->
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                @include('admin.layouts.topbar')
                <!--end::Header-->
                <!--begin::Content-->
                @yield('content')
                <!--end::Content-->
                <!--begin::Footer-->
                @include('admin.layouts.footer')
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--begin::Drawers-->
    @include('admin.layouts.topbar_drawer')
    <!--end::Drawers-->
</body>
<!--end::Body-->
@include('admin.layouts.script')
@stack('custom-scripts')
</html>
