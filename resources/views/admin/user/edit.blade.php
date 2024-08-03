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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Edit User</h1>
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
            <form action="{{route('admin.user.update', $item->id)}}" class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10" method="POST">
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
                            <div class="row">
                                <div class="col-md-4">
                                    <x-admin.single-img-upload inputName="image" fillValue="{{$item->image}}" />
                                </div>
                                <div class="col-md-8">
                                <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="required form-label">Name</label>
                                        <!--end::Label-->
                                        <input type="text" name="name" value="{{ $item->name }}" class="form-control" />
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="required form-label">UserName</label>
                                        <!--end::Label-->
                                        <input type="text" name="username" value="{{ $item->username }}" class="form-control" />
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="required form-label">Email</label>
                                        <!--end::Label-->
                                        <input type="text" name="email" value="{{ $item->email }}" class="form-control" />
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <!--begin::Label-->
                                        <label class="required form-label">Phone</label>
                                        <!--end::Label-->
                                        <input type="text" name="phone" value="{{ $item->phone }}" class="form-control" />
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Level</label>
                                        <!--end::Label-->
                                        <select name="level" required class="form-select mb-2" data-placeholder="Select an option">
                                            @foreach(\App\Enums\MemberLevel::getMap() as $v => $l)
                                            <option {{$item->level == \App\Enums\MemberLevel::from($v) ? 'selected' : ''}} value="{{$v}}">{{$l}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-10 fv-row">
                                        <label class="col-lg-4 col-form-label fw-bold fs-6">Status</label>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="is_active" type="checkbox" {{$item->is_active ? 'checked' : ''}} role="switch" id="flexSwitchCheckChecked">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Card header-->
                    </div>
                    <!--end::General options-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Button-->
                        <a href="{{route('admin.user.index')}}" id="kt_user_cancel" class="btn btn-light me-5">Back</a>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Save</span>
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