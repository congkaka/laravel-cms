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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Cài đặt hình ảnh</h1>
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
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">Hình ảnh</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form id="kt_account_profile_details_form" class="form" action="{{route('admin.setting.update')}}" method="post">
                        @csrf
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-6 card-body border-top p-9 footer_column">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Logo</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <x-single-img-upload inputName="logo" fillValue="{{isset($setting['logo']) ? $setting['logo'] : ''}}"/>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::test-->
                            <div class="row mb-6 card-body border-top p-9 footer_column">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Slide</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    @include('admin.setting.setting_multi_image_item', ['block' => 'slide'])
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::test-->
                            <!--begin::Input group-->
                            <div class="row mb-6 card-body border-top p-9 footer_column">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Slide</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <x-mutiple-img-upload inputName="slide" fillValues="{{isset($setting['slide']) ? implode(',', $setting['slide']) : '' }}"/>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6 card-body border-top p-9 footer_column">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Banner chính</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <x-mutiple-img-upload inputName="main_banner" fillValues="{{isset($setting['main_banner']) ? implode(',', $setting['main_banner']) : '' }}"/>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6 card-body border-top p-9 footer_column">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Banner phụ</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8">
                                    <!--begin::Row-->
                                    <x-mutiple-img-upload inputName="sub_banner" fillValues="{{isset($setting['sub_banner']) ? implode(',', $setting['sub_banner']) : '' }}"/>
                                    <!--end::Row-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
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
@endpush
