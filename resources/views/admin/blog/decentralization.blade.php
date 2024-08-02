@push('custom-css')
@endpush
@extends('admin.layouts.app')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <ol class="breadcrumb text-muted fs-6 fw-semibold">
                    <li class="breadcrumb-item"><a href="/cms" class="">Home</a></li>
                    <li class="breadcrumb-item"><a href="/cms/user" class="">User</a></li>
                    <li class="breadcrumb-item text-muted">Phân quyền</li>
                </ol>
            </div>
        </div>
    </div>
    <!--end::Toolbar-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <form action="{{ route('admin.user.update.permissions', ['user_id' => $user->id]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <div class="py-5">
                            <div class="rounded border p-10">
                                <div class="mb-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            {{ $user->name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="py-5">
                            <div class="rounded border p-10">
                                <div class="mb-10">
                                    <div class="row">
                                        @foreach($permissions as $permission)
                                        <div class="col-2 mb-5">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value= "{{ $permission->name }}" name="permission_list[]" 
                                                @if($user->can($permission->name)) checked @endif>
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
@endpush