@extends('admin.layouts.app',['pageTitle'=>'Cài đặt chân trang'])
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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Cài đặt chân trang</h1>
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
                            <h3 class="fw-bolder m-0">Cài đặt chân trang</h3>
                        </div>
                        <!--end::Card title-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <!--begin::Add product-->
                            <button class="btn btn-primary add_footer_column">Thêm cột</button>
                            <!--end::Add product-->
                        </div>
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_account_profile_details_form" class="form" action="{{route('admin.setting.update')}}" method="post">
                            @csrf
                            <div id="footer_content">
                                @if($setting && $setting['footer'])
                                    @foreach($setting['footer'] as $k => $f)
                                        <div class="card-body border-top p-9 footer_column" id="{{$k}}">
                                            <div class="row">
                                                <div class="mb-2 col-8">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">Tiêu đề cột</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" required name="footer[{{$k}}][title]" class="form-control mb-2" placeholder="Tiêu đề cột" value="{{$f['title']}}">
                                                    <!--end::Input-->
                                                </div>
                                                <div class="mb-2 col-2">
                                                    <label class="form-label">Thêm menu</label>
                                                    <button type="button" class="btn btn-primary btn_add_menu">Thêm menu</button>
                                                </div>
                                                <div class="mb-2 col-2">
                                                    <span class="btn_remove_column">
                                                        <i class="bi bi-x-lg text-danger"></i>
                                                    </span>
                                                </div>
                                            </div>
                                            @if(isset($f['item']) && $f['item'])
                                                @foreach($f['item'] as $i)
                                                <div class="row">
                                                    <div class="mb-1 fv-row col-5">
                                                        <!--begin::Input-->
                                                        <input type="text" required name="footer[{{$k}}][name][]" class="form-control mb-2" placeholder="Tên menu" value="{{$i['name']}}">
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="mb-1 fv-row col-5">
                                                        <!--begin::Input-->
                                                        <input type="text" required name="footer[{{$k}}][target][]" class="form-control mb-2" placeholder="Link liên kết" value="{{$i['target']}}">
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="mb-1 fv-row col-2 d-flex align-items-center">
                                                        <span class="btn_remove_item">
                                                            <i class="bi bi-x-lg text-danger"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
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
        $('.add_footer_column').on('click', function (){
            let max = 0;
            $('.footer_column').each(function(){
                max = max > parseInt($(this).attr('id')) ? max : parseInt($(this).attr('id'));
            });

            let id = max + 1;
            let html = `
            <div class="card-body border-top p-9 footer_column" id="${id}">
                <div class="row">
                    <div class="mb-2 col-8">
                        <label class="required form-label">Tiêu đề cột</label>
                        <input type="text" required name="footer[${id}][title]" class="form-control mb-2" placeholder="Tiêu đề cột" value="">
                    </div>
                    <div class="mb-2 col-2">
                        <label class="form-label">Thêm menu</label>
                        <button type="button" class="btn btn-primary btn_add_menu">Thêm menu</button>
                    </div>
                    <div class="mb-2 col-2">
                        <span class="btn_remove_column">
                            <i class="bi bi-x-lg text-danger"></i>
                        </span>
                    </div>
                </div>
            </div>
            `;
            $('#footer_content').append(html)
        })

        $(document).on('click', '.btn_remove_column', function (){
            $(this).parents(".footer_column").remove()
        })
        $(document).on('click', '.btn_remove_item', function (){
            $(this).parents(".row").remove()
        })

        $(document).on('click', '.btn_add_menu', function (){
            var parentId = $(this).parents(".footer_column").prop('id');
            var html = `
            <div class="row">
                <div class="mb-1 fv-row col-5">
                    <input type="text" required name="footer[${parentId}][name][]" class="form-control mb-2" placeholder="Tên menu" value="">
                </div>
                <div class="mb-1 fv-row col-5">
                    <input type="text" required name="footer[${parentId}][target][]" class="form-control mb-2" placeholder="Link liên kết" value="">
                </div>
                <div class="mb-1 fv-row col-2 d-flex align-items-center">
                    <span class="btn_remove_item">
                        <i class="bi bi-x-lg text-danger"></i>
                    </span>
                </div>
            </div>
            `;
            $(this).parents(".footer_column").append(html)
        })
    </script>
@endpush
