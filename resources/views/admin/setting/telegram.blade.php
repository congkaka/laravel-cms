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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Cài đặt mua bán</h1>
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
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_account_profile_details_form" class="form" action="{{route('admin.setting.update')}}" method="post">
                            @csrf
                            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                                <!--begin::Card title-->
                                <div class="card-title m-0">
                                    <h3 class="fw-bolder m-0">Telegram</h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <div>
                                <div class="card-body border-top p-9 footer_column">
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-bold fs-6">Telegram link</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="telegram[link]" class="form-control" value="{{ isset($setting['telegram']['link']) ? $setting['telegram']['link'] : ''}}" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-bold fs-6">Telegram token</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="telegram[token]" class="form-control" value="{{ isset($setting['telegram']['token']) ? $setting['telegram']['token'] : ''}}" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-4 col-form-label fw-bold fs-6">Telegram chat id</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-8 fv-row">
                                            <input type="text" name="telegram[chatid]" class="form-control" value="{{ isset($setting['telegram']['chatid']) ? $setting['telegram']['chatid'] : ''}}" />
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                </div>
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
    <!--end::Content-->
@endsection
@push('custom-scripts')
    <script>
        $(document).on("click", ".btn_remove_item", function () {
            $(this).parents(".row").remove();
        });

        $(document).on("click", ".btn_add_menu", function () {
            var parentId = $(this).parents(".footer_column").prop("id");
            var html = `
            <div class="row">
                <div class="mb-1 fv-row col-5">
                    <input type="text" required name="${parentId}[network][]" class="form-control mb-2" placeholder="Mạng" value="">
                </div>
                <div class="mb-1 fv-row col-5">
                    <input type="text" required name="${parentId}[address][]" class="form-control mb-2" placeholder="Địa chỉ" value="">
                </div>
                <div class="mb-1 fv-row col-2">
                    <span class="btn_remove_item">
                        <i class="bi bi-x-lg text-danger"></i>
                    </span>
                </div>
            </div>
            `;
            $(this).parents(".footer_column").append(html);
        });
    </script>
@endpush
