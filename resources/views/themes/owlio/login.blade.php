<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignZone">
    <meta name="robots" content="">
    <meta name="keywords"
          content="facebook, live, eye, like, share">
    <meta name="description"
          content="Hệ Thống Dịch Vụ Mạng Xã Hội Facebook | Youtube | Instagram | TikTok ">
    <meta property="og:title" content="Hệ Thống Dịch Vụ Mạng Xã Hội Facebook | Youtube | Instagram | TikTok ">
    <meta property="og:description"
          content="Hệ Thống Dịch Vụ Mạng Xã Hội Facebook | Youtube | Instagram | TikTok ">
    <meta property="og:image" content="../social-image.png">
    <meta name="format-detection" content="telephone=no">
    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicons Icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Page Title Here -->
    <title>Hệ Thống Dịch Vụ Mạng Xã Hội Facebook | Youtube | Instagram | TikTok</title>
    <link rel="stylesheet" href="{{asset('/owlio/vendor/chartist/css/chartist.min.css')}}">
    <link href="{{asset('/owlio/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('/owlio/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}"
          rel="stylesheet">
    <link href="{{asset('/owlio/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('owlio/vendor/toastr/css/toastr.min.css')}}">
</head>
<body class="vh-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <img src="images/logo-full.png" alt="">
                                </div>
                                <h4 class="text-center mb-4">Đăng Nhập Tài Khoản</h4>
                                <form method="post" name="login">
                                    @csrf
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Tài khoản</strong></label>
                                        <input type="text" name="username" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Mật khẩu</strong></label>
                                        <input type="password" name="password" class="form-control" value="Password">
                                    </div>
                                    <div class="row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group">
                                            <div class="form-check custom-checkbox ms-1">
                                                <input type="checkbox" class="form-check-input" id="basic_checkbox_1">
                                                <label class="form-check-label" for="basic_checkbox_1">Ghi nhớ tài khoản.</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a href="javascript:void(0)">Quên mật khẩu?</a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Chưa có tài khoản ? <a class="text-primary" href="{{route('register')}}">Đăng ký</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<!-- Required vendors -->
<script src="{{asset('owlio/vendor/global/global.min.js')}}"></script>
<script src="{{asset('owlio/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('owlio/vendor/peity/jquery.peity.min.js')}}"></script>
<script src="{{asset('owlio/js/custom.min.js')}}"></script>
<script src="{{asset('owlio/js/deznav-init.js')}}"></script>
<script src="{{asset('owlio/vendor/toastr/js/toastr.min.js')}}"></script>
<script>
    @if(session('success') && !session('error'))
    toastr.success("{{ session('success') }}", "", {
        showDuration: "300",
        hideDuration: "1000",
        extendedTimeOut: "1000"
    })
    @endif
    @if(session('error'))
    toastr.error("{{ session('error') }}", "", {
        showDuration: "300",
        hideDuration: "1000",
        extendedTimeOut: "1000"
    })
    @endif
</script>

</html>
