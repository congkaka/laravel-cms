@extends('admin.layouts.app')
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Cài đặt số lượng</h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_profile_details_form" class="form" action="{{route('admin.csetting.coin')}}" method="post">
                        <div style="max-height: 500px; overflow: scroll">
                            @csrf
                            <!--begin::Card body-->
                            <div class="row p-3">
                                <div class="col" style="width: 20%">
                                    <div style="display: flex; align-items: center;">
                                        <b style="padding-left: 10px" class="curreny-name">Coin</b>
                                    </div>
                                </div>
                                <div class="col" style="width: 10%">
                                    <span>Giá hiện tại</span>
                                </div>
                                <div class="col" style="width: 30%">
                                    <span>Lượng mua tối thiểu</span>
                                </div>
                                <div class="col" style="width: 30%">
                                    <span>Lượng bán tối thiểu</span>
                                </div>
                            </div>
                            <div style="border-top: 1px solid #aea4a442"></div>
                            @php
                            $index = 0
                            @endphp
                            @foreach($coins as $c)
                                <div class="row p-3">
                                    <div class="col" style="width: 20%">
                                        <div style="display: flex; align-items: center;">
                                            <div>
                                                <img width="35" height="35" src="{{asset('access/'.$c->coin.'.png')}}">
                                            </div>
                                            <b style="padding-left: 10px" class="curreny-name">{{$c->name}}</b>
                                        </div>
                                    </div>
                                    <div class="col" style="width: 10%">
                                        ～<b class="text-success font-weight-bold" id="price_mua_{{strtoupper($c->coin)}}"></b>
                                    </div>
                                    <div class="col" style="width: 30%">
                                        <input type="text" hidden name="coin[{{$index}}][coin]" value="{{$c->coin}}">
                                        <input class="form-control" type="number" name="coin[{{$index}}][min_buy]" value="{{$c->min_buy}}">
                                    </div>
                                    <div class="col" style="width: 30%">
                                        <input class="form-control" type="number" name="coin[{{$index}}][min_sell]" value="{{$c->min_sell}}">
                                    </div>
                                </div>
                                <div style="border-top: 1px solid #aea4a442"></div>
                                @php
                                $index ++;
                                @endphp
                            @endforeach
                            <!--end::Card body-->
                        </div>
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Lưu</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<input type="hidden" id="mua_vao" value="24124">
<input type="hidden" id="ban_ra" value="24199">
<input type="hidden" id="fee_mua_vao" value="0">
<input type="hidden" id="fee_ban_ra" value="0">
<!--end::Content-->
@endsection
@push('custom-scripts')
    <script>
        var devvn_theme_array = {
            "ajaxurl": "https://coinvietnam.net/wp-admin/admin-ajax.php",
            "recaptcha": "",
            "recaptcha_sitekey": "",
            "distance_format_num_decimals": "0",
            "distance_format_symbol": "VND",
            "distance_format_decimal_sep": ",",
            "distance_format_thousand_sep": ".",
            "distance_format": "%v %s",
            "telegram_token": "",
            "telegram_chatID": ""
        };
    </script>
    <script type="text/javascript" src="https://coinvietnam.net/wp-includes/js/jquery/jquery.min.js?ver=3.7.0"
            id="jquery-core-js"></script>
    <script type='text/javascript'
            src='https://coinvietnam.net/wp-content/themes/devvn-child/js/accounting.min.js?ver=1.0'
            id='accounting-js'></script>
    <script type='text/javascript'
            src='https://coinvietnam.net/wp-content/themes/devvn-child/js/jquery.validate.min.js?ver=1.0'
            id='jquery.validate-js'></script>
    <script src="{{asset('access/main.js')}}"></script>
@endpush
