@extends('themes.owlio.layouts.app')
@section('content')
    <div class="container">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Nạp tiền</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h6 class="mb-3">Nhập số tiền cần nạp<span class="text-danger">*</span></h6>
                        </div>
                        <div class="row">
                            <div class="col-md-10 order-lg-1">
                                <input type="number" id="amount" name="amount" required="" class="form-control">
                            </div>
                            <div class="col-md-2 order-lg-1">
                                <button class="btn btn-primary btn-block" id="btn_pay" type="submit">
                                    Thanh toán
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <div id="bankqrcode">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>
        $('#btn_pay').on('click', function () {
            var amount = $('#amount').val();
            if (!amount || amount < 10000) {
                toastr.error("Số tiền tối thiểu là 10.000")
                return;
            }
            $.post("{{route('deposit')}}",
                {
                    'amount': amount,
                    '_token': "{{ csrf_token() }}"
                },
                function (res) {
                    var imgLink = "https://img.vietqr.io/image/{{$setting['bank']['bank_code']}}-{{$setting['bank']['bank_number']}}-print.png?accountName={{$setting['bank']['bank_owner']}}&addInfo=" + res.code + "&amount=" + amount;

                    var img = `
                            <em class="text-warning" style="max-width: 500px;">
                                (Cảm ơn bạn. Sau khi chuyển khoản bạn có thể kiểm tra lại trong lịch sử ví, nếu quá 10 phút từ lúc chuyển khoản mà bạn chưa được cộng tài khoản, vui lòng để lại tin nhắn trong mục hỗ trợ)
                            </em><br>
                            <img  width="400" src="${imgLink}" >`;
                    $('#bankqrcode').html(img);
                })
        })
    </script>
@endpush
