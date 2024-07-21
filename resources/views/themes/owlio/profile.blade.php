@extends('themes.owlio.layouts.app')
@section('content')
    <div class="container">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hồ sơ cá nhân</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 order-lg-1">
                                <form class="needs-validation" action="http://127.0.0.1:8000/mua-dich-vu/13" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <h6 class="mb-3">Tên</h6>
                                        <input type="text" class="form-control form-control-sm" name="name" value="{{$user->name}}">
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <h6 class="mb-3">Số điện thoại</h6>
                                            <input type="text" class="form-control form-control-sm" name="phone" value="{{$user->phone}}">
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="mb-3">Email</h6>
                                            <input type="text" class="form-control form-control-sm" name="email" value="{{$user->email}}">
                                        </div>
                                    </div>
                                    <!-- <em class="text-warning">Sau khi lấy token bạn hãy cop và lưu nó ra một chỗ khác để sử dụng</em>
                                    <div class="input-group mb-3">
                                        <input type="text" id="tokenres" disabled class="form-control form-control-sm">
                                        <button class="btn btn-success btn-sm" id="btn-get-token" type="button">Lấy api token</button>
                                    </div> -->
                                    <div class="mb-3">
                                        <h6 class="mb-3">Username</h6>
                                        <input type="text" class="form-control form-control-sm" disabled value="{{$user->username}}">
                                    </div>
                                    <!-- <div class="mb-3">
                                        <h6 class="mb-3">Số dư</h6>
                                        <input type="text" class="form-control form-control-sm" disabled value="{{$user->balance}}">
                                    </div> -->
                                    <div class="mb-3">
                                        <h6 class="mb-3">Cấp bậc</h6>
                                        <input type="text" class="form-control form-control-sm" disabled value="{{ $user->is_admin ? 'Admin' : $user->level}}">
                                    </div>
                                    <hr class="mb-4">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Lưu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>
        $('#btn-get-token').on('click', function () {
            var url = "{{route('create_token')}}";
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    _method: 'POST',
                    "_token": "<?php echo e(csrf_token()); ?>"
                },
                url,
                success: function(data) {
                    $('#tokenres').val(data.token)
                }
            });
        })
    </script>
@endpush
