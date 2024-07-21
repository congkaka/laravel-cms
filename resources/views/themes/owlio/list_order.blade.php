@extends('themes.owlio.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Lịch sử tạo đơn</h4>
{{--                    <p class="mb-0">Your business dashboard template</p>--}}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead>
                                <tr>
                                    <th class="align-middle">Mã đơn hàng</th>
                                    <th class="align-middle pe-7">Thời gian</th>
                                    <th class="align-middle pe-7">Link/Uid</th>
                                    <th class="align-middle">Dịch vụ</th>
                                    <th class="align-middle">Ghi chú</th>
                                    <th class="align-middle text-end">Số lượng</th>
                                    <th class="align-middle text-end">Số tiền</th>
                                    <th class="align-middle text-end">Thời gian chạy</th>
                                    <th class="align-middle text-end">Trạng thái</th>
                                </tr>
                                </thead>
                                <tbody id="orders">
                                @foreach($orders as $o)
                                    <tr class="btn-reveal-trigger">
                                        <td class="py-2">{{$o->code}}</td>
                                        <td class="py-2">{{toClientTime($o->created_at)}}</td>
                                        <td class="py-2">{{$o->uid}}</td>
                                        <td class="py-2">
                                            - Dịch vụ: <strong class="text-primary">{{$o->product}}</strong><br>
                                            - Gói: <strong class="text-primary">{{$o->product_variant}}</strong><br>
                                        </td>
                                        <td class="py-2 text-end">{{$o->note}}</td>
                                        <td class="py-2 text-end">{{number_format($o->quantity)}}</td>
                                        <td class="py-2 text-end">{{number_format($o->amount)}}</td>
                                        <td class="py-2 text-end">{{$o->execution_time ? number_format($o->execution_time) .' p': ''}}</td>
                                        <td class="py-2 text-end">
                                            @if($o->status == \App\Enums\OrderStatus::PENDING)
                                                <span class="badge badge-warning light">Chờ xử lý<span
                                                        class="ms-1 fas fa-stream"></span></span>
                                            @elseif($o->status == \App\Enums\OrderStatus::PROCESSING)
                                                <span class="badge badge-primary light">Đang xử lý<span
                                                        class="ms-1 fa fa-redo"></span></span>
                                            @elseif($o->status == \App\Enums\OrderStatus::SUCCESS)
                                                <span class="badge badge-success light">Hoàn thành<span
                                                        class="ms-1 fa fa-check"></span></span>
                                            @elseif($o->status == \App\Enums\OrderStatus::CANCEL)
                                                <span class="badge badge-secondary light">Hủy<span
                                                        class="ms-1 fa fa-ban"></span></span>
                                            @elseif($o->status == \App\Enums\OrderStatus::CASH_BACK)
                                                <span class="badge badge-secondary light">Hoàn tiền<span
                                                        class="ms-1 fa fa-ban"></span></span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            {{ $orders->appends($_GET)->links('admin.custom.pagination')}}
        </div>
    </div>
@endsection
@push('custom-scripts')
@endpush
