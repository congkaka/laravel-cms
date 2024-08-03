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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Sửa phân loại</h1>
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
            <form id="kt_ecommerce_add_product_variant_form" method="post" action="{{route('admin.product_variant.update',$item->id)}}" class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10" method="POST">
                @method('PUT')
                @csrf
                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-12 gap-lg-12">
                    <!--begin::General options-->
                    <div class="card card-flush py-4">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <!--<h2>General</h2>-->
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Dịch vụ</label>
                                <!--end::Label-->
                                <select name="product_id" required class="form-select mb-2" data-control="select2" data-placeholder="Select an option">
                                    @foreach($products as $p)
                                    <option {{$item->product_variant_id == $p['id'] ? 'selected' : ''}} value="{{$p['id']}}">{{$p['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Tên phân loại</label>
                                <!--end::Label-->
                                <input required type="text" name="name" value="{{$item->name}}" class="form-control" />
                            </div>
                            <div class="row p-0">
                                <div class="mb-10 fv-row col-md-4">
                                    <label class="required form-label">Giá</label>
                                    <!--end::Label-->
                                    <input required type="number" name="price" value="{{$item->price}}" step="0.1" class="form-control" />
                                </div>
                                <div class="mb-10 fv-row col-md-4">
                                    <label class="required form-label">Giá cộng tác viên</label>
                                    <!--end::Label-->
                                    <input required type="number" name="price_ctv" value="{{$item->price_ctv}}" step="0.1" class="form-control" />
                                </div>
                                <div class="mb-10 fv-row col-md-4">
                                    <label class="required form-label">Giá đại lý</label>
                                    <!--end::Label-->
                                    <input required type="number" name="price_agency" value="{{$item->price_agency}}" step="0.1" class="form-control" />
                                </div>
                            </div>
                            <div class="row p-0">
                                <div class="mb-10 fv-row col-md-4">
                                    <label class="required form-label">Số lượng mua tối thiểu</label>
                                    <!--end::Label-->
                                    <input required type="number" name="min_sale_quantity" value="{{$item->min_sale_quantity}}" step="1" class="form-control" />
                                </div>
                                <div class="mb-10 fv-row col-md-4">
                                    <label class="required form-label">Số lượng mua tối đa</label>
                                    <!--end::Label-->
                                    <input required type="number" name="max_sale_quantity" value="{{$item->max_sale_quantity}}" step="1" class="form-control" />
                                </div>
                            </div>
                            <div class="mb-10 fv-row">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">Status</label>
                                <div class="form-check form-switch">
                                    <input required class="form-check-input" value="1" name="is_active" type="checkbox" {{$item->is_active ? 'checked' : ''}} role="switch" id="flexSwitchCheckChecked">
                                </div>
                            </div>
                            <!--end::Card header-->
                        </div>
                        <!--end::General options-->
                        <div class="d-flex justify-content-end">
                            <!--begin::Button-->
                            <a href="{{route('admin.product_variant.index')}}" id="kt_ecommerce_add_product_variant_cancel" class="btn btn-light me-5">Back</a>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                <span class="indicator-label">Save</span>
                                <span class="indicator-progress">Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
            </form>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection