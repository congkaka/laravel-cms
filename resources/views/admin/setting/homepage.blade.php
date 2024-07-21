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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Cài đặt nội dùng trang chủ</h1>
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
    <div class="post d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-xxl">
            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" aria-expanded="true">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">Danh mục nổi bật</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div class="collapse show">
                    <!--begin::Form-->
                    <form class="form" action="{{route('admin.setting_content.update')}}" method="post">
                        @csrf
                        <!--begin::Card body-->
                        <div class="card-body border-top">
                            <div class="fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Chọn danh mục nổi bật</label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="form-select" name="hot_categories[]" data-control="select2" data-close-on-select="false" data-placeholder="Chọn danh mục nổi bật" multiple>
                                    <option></option>
                                    @foreach($categories as $c)
                                    <option {{in_array($c['id'],$setting['hot_categories']) ? 'selected': ''}} value="{{$c['id']}}">
                                        {{$c['name']}}
                                    </option>
                                    @endforeach
                                </select>
                                <!--end::Select2-->
                            </div>
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
    <div class="post d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-xxl">
            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" aria-expanded="true">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">Nhóm sản phẩm</h3>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <!--begin::Add product-->
                        <button class="btn btn-primary add_group">Thêm nhóm</button>
                        <!--end::Add product-->
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div class="collapse show">
                    <!--begin::Form-->
                    <form class="form" action="{{route('admin.setting_content.update')}}" method="post">
                        @csrf
                        <div id="block_group">
                            @if($setting && $setting['product_block'])
                                @foreach($setting['product_block'] as $gk => $g)
                                    <div class="card-body border-top p-9 block_group_item border border-primary mb-5" id="{{$gk}}">
                                <div class="fv-row row">
                                    <div class="mb-10 col-9">
                                        <label class="required form-label">Tên nhóm</label>
                                        <input type="text" required name="product_block[{{$gk}}][name]" class="form-control mb-2" value="{{$g['name']}}">
                                    </div>
                                    <div class="mb-2 col-2">
                                        <label class="form-label">Thêm khối</label>
                                        <button type="button" class="btn btn-primary btn_add_block">Thêm khối</button>
                                    </div>
                                    <div class="mb-2 col-1 d-flex align-items-center">
                                        <span class="btn_remove_group">
                                            <i class="bi bi-x-lg text-danger"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="block">
                                    @if($g['block'])
                                        @foreach($g['block'] as $bk => $b)
                                            <div class="fv-row row block_item mb-10 border border-warning" id="{{$bk}}">
                                        <div class="col-2">
                                            <label class="form-label">Banner khối</label>
                                            <x-single-img-upload inputName="product_block[{{$gk}}][block][{{$bk}}][banner]"/>
                                        </div>
                                        <div class="col-9">
                                            <div class="mb-10 fv-row">
                                                <label class="required form-label">Tên khối</label>
                                                <input type="text" required name="product_block[{{$gk}}][block][{{$bk}}][name]" class="form-control mb-2" value="{{$b['name']}}">
                                            </div>
                                            <div class="mb-10 fv-row">
                                                <label class="required form-label">Link xem thêm</label>
                                                <input type="text" required name="product_block[{{$gk}}][block][{{$bk}}][more]" class="form-control mb-2" placeholder="Link xem thêm" value="{{isset($b['more']) ? $b['more'] : ''}}">
                                            </div>
                                            <div class="fv-row">
                                                <label class="required form-label">Chọn sản phẩm</label>
                                                <select required class="form-select mb-2" name="product_block[{{$gk}}][block][{{$bk}}][product_ids][]" data-control="select2" data-close-on-select="false" data-placeholder="Chọn sản phẩm" multiple>
                                                    @foreach($products as $p)
                                                        <option {{in_array($p['id'], $b['product_ids']) ? 'selected' : ''}} value="{{$p['id']}}">
                                                            {{$p['name']}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-1">
                                            <span class="btn_remove_block">
                                                <i class="bi bi-x-lg text-danger"></i>
                                            </span>
                                        </div>
                                    </div>
                                        @endforeach
                                    @endif
                                </div>
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
        $('.add_group').on('click', function (){
            let max = 0;
            $('.block_group_item').each(function(){
                max = max > parseInt($(this).attr('id')) ? max : parseInt($(this).attr('id'));
            });

            let id = max + 1;

            let html = `
            <div class="card-body border-top p-9 block_group_item border border-primary mb-5" id="${id}">
                <div class="fv-row row">
                    <div class="mb-10 col-9">
                        <label class="required form-label">Tên nhóm</label>
                        <input type="text" required name="product_block[${id}][name]" class="form-control mb-2" value="">
                    </div>
                    <div class="mb-2 col-2">
                        <label class="form-label">Thêm khối</label>
                        <button type="button" class="btn btn-primary btn_add_block">Thêm khối</button>
                    </div>
                    <div class="mb-2 col-1 d-flex align-items-center">
                        <span class="btn_remove_group">
                            <i class="bi bi-x-lg text-danger"></i>
                        </span>
                    </div>
                </div>
                <div class="block">
                    <div class="fv-row row block_item mb-10 border border-warning" id="0">
                        <div class="col-2">
                            <label class="form-label">Banner khối</label>
                            <x-single-img-upload inputName="product_block[${id}][block][0][banner]"/>
                        </div>
                        <div class="col-9">
                            <div class="mb-10 fv-row">
                                <label class="required form-label">Tên khối</label>
                                <input type="text" required name="product_block[${id}][block][0][name]" class="form-control mb-2" value="">
                            </div>
                            <div class="mb-10 fv-row">
                                <label class="required form-label">Link xem thêm</label>
                                <input type="text" required name="product_block[${id}][block][0][more]" class="form-control mb-2" placeholder="Link xem thêm" value="">
                            </div>
                            <div class="fv-row">
                                <label class="required form-label">Chọn sản phẩm</label>
                                <select required class="form-select mb-2" name="product_block[${id}][block][0][product_ids][]" data-control="select2" data-close-on-select="false" data-placeholder="Chọn sản phẩm" multiple>
                                    <option></option>
                                    @foreach($products as $p)
                                        <option value="{{$p['id']}}">
                                            {{$p['name']}}
                                        </option>
                                   @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 col-1">
                            <span class="btn_remove_block">
                                <i class="bi bi-x-lg text-danger"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>`;
            $('#block_group').append(html)
            $('select').select2()
        })

        $(document).on('click', '.btn_remove_group', function (){
            $(this).parents(".block_group_item").remove()
        })

        //block
        $(document).on('click', '.btn_add_block', function (){
            let max = 0;
            $(this).parents('.block_group_item').find('.block_item').each(function(){
                console.log($(this).attr('id'))
                max = max > parseInt($(this).attr('id')) ? max : parseInt($(this).attr('id'));
            });
            let id = max + 1;

            let parent_id = $(this).parents('.block_group_item').attr('id');

            console.log(id, parent_id)

            let html = `
            <div class="fv-row row block_item mb-10 border border-warning" id="${id}">
                <div class="col-2">
                    <label class="form-label">Banner khối</label>
                    <x-single-img-upload inputName="product_block[${parent_id}][block][${id}][banner]"/>
                </div>
                <div class="col-9">
                    <div class="mb-10 fv-row">
                        <label class="required form-label">Tên khối</label>
                        <input type="text" required name="product_block[${parent_id}][block][${id}][name]" class="form-control mb-2" value="">
                    </div>
                    <div class="mb-10 fv-row">
                        <label class="required form-label">Link xem thêm</label>
                        <input type="text" required name="product_block[${parent_id}][block][${id}][more]" class="form-control mb-2" placeholder="Link xem thêm" value="">
                    </div>
                    <div class="fv-row">
                        <label class="required form-label">Chọn sản phẩm</label>
                        <select required class="form-select mb-2" name="product_block[${parent_id}][block][${id}][product_ids][]" data-control="select2" data-close-on-select="false" data-placeholder="Chọn sản phẩm" multiple>
                            <option></option>
                            @foreach($products as $p)
                            <option value="{{$p['id']}}">
                                {{$p['name']}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-2 col-1">
                    <span class="btn_remove_block">
                        <i class="bi bi-x-lg text-danger"></i>
                    </span>
                </div>
            </div>`;
            $(this).parents('.block_group_item').find('.block').append(html)
            $(this).parents('.block_group_item').find('select').select2()
        })

        $(document).on('click', '.btn_remove_block', function (){
            $(this).parents(".block_item").remove()
        })
    </script>
@endpush
