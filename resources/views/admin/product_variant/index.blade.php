@extends('admin.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <!--begin::Container-->
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <!--begin::Title-->
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Phân loại</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                </div>
                <a href="{{route('admin.product_variant.create')}}" class="btn btn-sm fw-bold btn-primary">Thêm</a>
                <!--end::Page title-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Category-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <form class="card-title" method="get">
                            <!--begin::Search-->
{{--                            <div class="d-flex align-items-center position-relative me-2">--}}
{{--                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->--}}
{{--                                <span class="svg-icon svg-icon-1 position-absolute ms-4">--}}
{{--                                    <i class="bi bi-search"></i>--}}
{{--                                </span>--}}
{{--                                <!--end::Svg Icon-->--}}
{{--                                <input type="text" name="name" data-kt-ecommerce-product-filter="search"--}}
{{--                                       class="form-control form-control-solid w-250px ps-14"--}}
{{--                                       value="{{Request::get('name')}}" placeholder="Tìm kiếm"/>--}}
{{--                            </div>--}}
                            <div class="d-flex align-items-center position-relative me-2">
                                <select  class="form-control form-control-solid w-250px ps-14" name="product_id" >
                                    <option selected value="">Chọn dịch vụ</option>
                                    @foreach($products as $p)
                                        <option {{Request::get('product_id') == $p->id ? 'selected' : ''}} value="{{$p->id}}">{{$p->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-search"></i>
                            </button>
                            <!--end::Search-->
                        </form>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Add customer-->
                            <!--end::Add customer-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_product_table">
                            <!--begin::Table head-->
                            <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th>ID</th>
                                <th>Dịch vụ</th>
                                <th>Server</th>
                                <th>Giá</th>
                                <th>Giá đại lý</th>
                                <th>Giá cộng tác viên</th>
                                <th>Mua tối thiểu</th>
                                <th>Mua tối đa</th>
                                <th>Trạng thái</th>
                            </tr>
                            <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">
                            <!--begin::Table row-->
                            @foreach($items as $i)
                                <tr>
                                    <td>
                                        {{$i['id']}}
                                    </td>
                                    <td>
                                        {{$i['product']['name']}}
                                    </td>
                                    <td>
                                        {{$i['name']}}
                                    </td>
                                    <td>
                                        {{$i['price']}} đ
                                    </td>
                                    <td>
                                        {{$i['price_agency']}} đ
                                    </td>
                                    <td>
                                        {{$i['price_ctv']}} đ
                                    </td>
                                    <td>
                                        {{$i['min_sale_quantity']}}
                                    </td>
                                    <td>
                                        {{$i['max_sale_quantity']}}
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input active_product" data-api="{{ route('admin.product_variant.change_active', $i->id) }}"
                                                   value="1" name="is_active" type="checkbox"
                                                   role="switch" {{ $i->is_active ? 'checked': '' }}>
                                        </div>
                                    </td>
                                    <!--end::Category=-->
                                    <!--begin::Action=-->
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary"
                                           data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Thao tác
                                            <i class="bi bi-chevron-down"></i>
                                        </a>
                                        <!--begin::Menu-->
                                        <div
                                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px"
                                            data-kt-menu="true">
                                            <div class="menu-item">
                                                <a href="{{route('admin.product_variant.edit', $i['id'])}}"
                                                   class="menu-link"><i
                                                        class="bi bi-pencil-square text-warning pe-3"></i>Sửa</a>
                                            </div>
                                            <div class="menu-item">
                                                <a href="{{route('admin.product_variant.destroy', $i['id'])}}"
                                                   class="menu-link delete_btn"><i
                                                        class="bi bi-trash text-danger pe-3"></i>Xóa</a>
                                            </div>
                                        </div>
                                        <!--end::Menu-->
                                    </td>

                                    <!--end::Action=-->
                                </tr>
                            @endforeach
                            <!--end::Table row-->
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Category-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <div class="container-xxl mt-3">
        {{ $items->appends($_GET)->links('admin.custom.pagination')}}
    </div>
@endsection
@push('custom-scripts')
    <script>
        $('.active_product').on('change', function (e) {
            var api = $(this).data('api');
            $.ajax({
                type: 'PUT',
                dataType: 'json',
                data: {
                    _method: 'PUT',
                    "_token": "{{ csrf_token() }}"
                },
                url: api,
                success: function(data) {
                    toastr.success("Thao tác thành công");
                }
            });
        })
    </script>
@endpush


