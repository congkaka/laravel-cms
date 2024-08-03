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
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Add Blog</h1>
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
            <form action="{{route('admin.blogs.store')}}" class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10" method="POST">
                @method('post')
                @csrf
                <input type="hidden" name="author_id" value="{{Auth::user()->id}}">
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
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Title</label>
                                        <input type="text" name="title" value="" class="form-control" />
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Slug</label>
                                        <input type="text" name="slug" value="" class="form-control" />
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Seo title</label>
                                        <input type="text" name="seo_title" value="" class="form-control" />
                                    </div>

                                    <div class="mb-10 input-group">
                                        <span class="input-group-text">Excerpt</span>
                                        <textarea class="form-control" name="excerpt" aria-label="excerpt"></textarea>
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Body</label>
                                        <textarea class="form-control" name="body" rows="4" id="kt_docs_ckeditor_classic" aria-label="excerpt"></textarea>
                                    </div>

                                    <x-admin.single-img-upload inputName="image" fillValue="" />
                                    <div class="mb-10"></div>

                                    <div class="mb-10 input-group">
                                        <span class="input-group-text">Meta Description</span>
                                        <textarea class="form-control" name="meta_description" aria-label="meta description"></textarea>
                                    </div>

                                    <div class="mb-10 input-group">
                                        <span class="input-group-text">Meta Keywords</span>
                                        <textarea class="form-control" name="meta_keywords" aria-label="meta keywords"></textarea>
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Store</label>
                                        <select name="store_id" required class="form-select mb-2" data-placeholder="Select an option">
                                            @foreach($stores as $store)
                                            <option value="{{$store->id}}">{{$store->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-10 fv-row">
                                        <label class="required form-label">Category</label>
                                        <select name="category_id" required class="form-select mb-2" data-placeholder="Select an option">
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-10 fv-row">
                                                <label class="col-lg-4 col-form-label fw-bold fs-6">Published</label>
                                                <select name="status" required class="form-select mb-2" data-placeholder="Select an option">
                                                    @foreach(\App\Enums\BlogStatus::getMap() as $v => $l)
                                                    <option value="{{$v}}">{{$l}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-10 fv-row">
                                                <label class="col-lg-4 col-form-label fw-bold fs-6">Featured</label>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" name="featured" type="checkbox">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{route('admin.blogs.index')}}" id="kt_user_cancel" class="btn btn-light me-5">Back</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Save</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
<script>
    ClassicEditor
       .create(document.querySelector('#kt_docs_ckeditor_classic'))
       .then(editor => {
            console.log(editor);
        })
       .catch(error => {
            console.error(error);
        });
</script>
@endpush