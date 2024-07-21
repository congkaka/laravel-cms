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
                                <h4 class="text-center mb-4">Đăng Ký Tài Khoản</h4>
                                <form action="{{route('register')}}" method="post">
                                    @csrf
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Tài khoản <span class="text-danger">*</span></strong></label>
                                        <input type="text" name="username" value="{{old('username')}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Mật khẩu <span class="text-danger">*</span></strong></label>
                                        <input type="password" name="password" value="{{old('password')}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Họ tên <span class="text-danger">*</span></strong></label>
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Email <span class="text-danger">*</span></strong></label>
                                        <input type="email" name="email" value="{{old('email')}}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1"><strong>Số điện thoại <span class="text-danger">*</span></strong></label>
                                        <input type="text" name="phone" value="{{old('phone')}}" class="form-control">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Đã có tài khoản ? <a class="text-primary" href="page-register.html">Đăng nhập</a></p>
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
<script src="{{asset('owlio/vendor/global/global.min.js')}}"></script>
<script src="{{asset('owlio/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('owlio/vendor/peity/jquery.peity.min.js')}}"></script>
<script src="{{asset('owlio/js/custom.min.js')}}"></script>
<script src="{{asset('owlio/js/deznav-init.js')}}"></script>
@stack('custom-scripts')

</html>
