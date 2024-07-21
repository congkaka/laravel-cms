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
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Order</h1>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <!--end::Separator-->
                </div>
                <a href="{{route('admin.order.create')}}" class="btn btn-sm fw-bold btn-primary">Thêm</a>
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
                            <div class="d-flex align-items-center position-relative me-2">
                                <select class="form-control form-control-solid form-select mb-2 w-200px" name="status"
                                        data-control="select2" data-allow-clear="true"
                                        data-placeholder="Chọn trạng thái" data-select2-id="status-default">
                                    <option data-select2-id="status-default"></option>
                                    @foreach(\App\Enums\OrderStatus::getMap() as $k => $v)
                                        <option
                                                {{Request::get('status') == $k ? 'selected' : ''}} value="{{$k}}">{{$v}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex align-items-center position-relative me-2">
                                <select class="form-control form-control-solid form-select mb-2 w-250px" name="user_id"
                                        data-control="select2" data-allow-clear="true"
                                        data-placeholder="Chọn user" data-select2-id="user-default">
                                    <option data-select2-id="user-default"></option>
                                    @foreach($users as $u)
                                        <option
                                                {{Request::get('user_id') == $u->id ? 'selected' : ''}} value="{{$u->id}}">{{$u->username.' - '.$u->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex align-items-center position-relative me-2">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                    <i class="bi bi-search"></i>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" name="keyword" data-kt-ecommerce-product-filter="search"
                                       class="form-control form-control-solid w-250px ps-14"
                                       value="{{Request::get('keyword')}}" placeholder=" Mã đơn hàng hoặc uid"/>
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
                        <div>
                            <h3>Tổng thanh toán : <span class="text-success">{{number_format($sum)}} đ</span></h3>
                        </div>
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_product_table">
                            <!--begin::Table head-->
                            <thead>
                            <!--begin::Table row-->
                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                <th>Tài khoản</th>
                                <th>Mã đơn hàng</th>
                                <th>Thời gian</th>
                                <th>Link/Uid</th>
                                <th>Dịch vụ</th>
                                <th>Ghi chú</th>
                                <th>Số lượng</th>
                                <th>Số tiền</th>
                                <th>Thời gian chạy</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                            <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bold text-gray-600">
                            <!--begin::Table row-->
                            @foreach($items as $i)
                                <tr>
                                    <td class="py-2">{{$i->user->username}}</td>
                                    <td class="py-2">{{$i->code}}</td>
                                    <td class="py-2">{{toClientTime($i->created_at)}}</td>
                                    <td class="py-2">{{$i->uid}}</td>
                                    <td class="py-2">
                                        - Dịch vụ: <strong class="text-primary">{{$i->product}}</strong><br>
                                        - Gói: <strong class="text-primary">{{$i->product_variant}}</strong><br>
                                    </td>
                                    <td class="py-2 text-end">{{$i->note}}</td>
                                    <td class="py-2 text-end">{{number_format($i->quantity)}}</td>
                                    <td class="py-2 text-end">{{number_format($i->amount)}}</td>
                                    <td class="py-2 text-end">{{$i->execution_time ? number_format($i->execution_time) .' p': ''}}</td>
                                    <td class="py-2 text-end">
                                        @if($i->status == \App\Enums\OrderStatus::PENDING)
                                            <span class="badge badge-warning light">Chờ xử lý<span
                                                        class="ms-1 fas fa-stream"></span></span>
                                        @elseif($i->status == \App\Enums\OrderStatus::PROCESSING)
                                            <span class="badge badge-primary light">Đang xử lý<span
                                                        class="ms-1 fa fa-redo"></span></span>
                                        @elseif($i->status == \App\Enums\OrderStatus::SUCCESS)
                                            <span class="badge badge-success light">Hoàn thành<span
                                                        class="ms-1 fa fa-check"></span></span>
                                        @elseif($i->status == \App\Enums\OrderStatus::CANCEL)
                                            <span class="badge badge-secondary light">Hủy<span
                                                        class="ms-1 fa fa-ban"></span></span>
                                        @elseif($i->status == \App\Enums\OrderStatus::CASH_BACK)
                                            <span class="badge badge-secondary light">Hoàn tiền<span
                                                    class="ms-1 fa fa-ban"></span></span>
                                        @endif
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
                                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px"
                                                data-kt-menu="true">
                                            @if( in_array($i->status , [\App\Enums\OrderStatus::PENDING]))
                                                <div class="menu-item">
                                                    <a href="{{route('admin.order.change_state', ['id' => $i->id, 'status' => \App\Enums\OrderStatus::PROCESSING])}}"
                                                       class="menu-link"><i
                                                                class="bi bi-cpu text-primary pe-3"></i>
                                                        Chuyển đến đang xử lý
                                                    </a>
                                                </div>
                                            @endif
                                            @if( in_array($i->status , [
                                                \App\Enums\OrderStatus::PENDING,
                                                \App\Enums\OrderStatus::PROCESSING
                                            ]))
                                                <div class="menu-item">
                                                    <a href="{{route('admin.order.change_state', ['id' => $i->id, 'status' => \App\Enums\OrderStatus::SUCCESS])}}"
                                                       class="menu-link"><i
                                                                class="bi bi-check-circle text-success pe-3"></i>
                                                        Chuyển đến hoàn thành
                                                    </a>
                                                </div>
                                                <div class="menu-item">
                                                    <a href="{{route('admin.order.change_state', ['id' => $i->id, 'status' => \App\Enums\OrderStatus::CANCEL])}}"
                                                       class="menu-link"><i
                                                                class="bi bi-x-circle text-danger pe-3"></i>
                                                        Chuyển đến hủy
                                                    </a>
                                                </div>
                                            @endif
                                            @if( !in_array($i->status , [
                                                \App\Enums\OrderStatus::SUCCESS,
                                                \App\Enums\OrderStatus::CASH_BACK,
                                            ]))
                                                <div class="menu-item">
                                                    <a href="{{route('admin.order.change_state', ['id' => $i->id, 'status' => \App\Enums\OrderStatus::CASH_BACK])}}"
                                                       class="menu-link"><i
                                                                class="bi bi-x-circle text-danger pe-3"></i>
                                                        Hoàn tiền
                                                    </a>
                                                </div>
                                            @endif
                                            <div class="menu-item">
                                                <a href="{{route('admin.order.show', $i->id)}}" class="menu-link"><i
                                                            class="bi bi-ticket-detailed text-success pe-3"></i>Chi tiết</a>
                                            </div>
                                            <div class="menu-item">
                                                <a href="{{route('admin.order.edit', $i->id)}}" class="menu-link"><i
                                                            class="bi bi-pencil-square text-warning pe-3"></i>Sửa</a>
                                            </div>
                                            <div class="menu-item">
                                                <a href="{{route('admin.order.destroy', $i->id)}}"
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
@endpush


