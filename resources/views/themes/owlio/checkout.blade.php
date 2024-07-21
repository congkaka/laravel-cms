@extends('themes.owlio.layouts.app')
@section('content')
    <div class="container">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>{{$product->name}}</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @if($product->is_active)
                                <div class="col-lg-12 order-lg-1">
                                    <form class="needs-validation" action="{{route('order', $product->id)}}"
                                          method="post">
                                        @csrf
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="mb-3">
                                            <h6 class="mb-3">Link/UID <span class="text-danger">*</span></h6>
                                            <input type="text" required class="form-control" id="uid" name="uid"
                                                   value="{{ old('uid')}}">
                                        </div>

                                        <h6 class="mb-3">Chọn dịch vụ <span class="text-danger">*</span></h6>
                                        <div class="d-block my-3">
                                            @if($product->variants)
                                                @foreach($product->variants as $v)
                                                    @php
                                                        $price = $v->price;
                                                        if (Auth::user()->level == \App\Enums\MemberLevel::CTV) {
                                                            $price = $v->price_ctv;
                                                        }
                                                        if (Auth::user()->level == \App\Enums\MemberLevel::AGENCY) {
                                                            $price = $v->price_agency;
                                                        }
                                                    @endphp
                                                    <div class="form-check custom-radio mb-2">
                                                        <input {{$v->is_active ? '' : 'disabled'}} id="{{$v->id}}"
                                                               name="variant_id"
                                                               {{old('variant_id') == $v->id ? 'checked' : ''}}  type="radio"
                                                               value="{{$v->id}}"
                                                               class="form-check-input" required>
                                                        <label class="form-check-label" for="{{$v->id}}">{{$v->name}}
                                                            - <span class="text-warning">{{$price}} đ</span>
                                                            -
                                                            ({!! $v->is_active ? '<span class="text-success">Hoạt động</span>' : '<span class="text-warning">Bảo trì</span>' !!}
                                                            )</label>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="text-warning text-center">Tất cả các server đang bảo trì, vui
                                                    lòng quay lại sau</p>
                                            @endif
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="mb-3">Số lượng cần tăng <span class="text-danger">*</span></h6>
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="quantity" name="quantity"
                                                       value="{{ old('quantity')}}"
                                                       min="{{$product->min_sale_quantity}}"
                                                       max="{{$product->max_sale_quantity}}"
                                                       placeholder="Tối thiểu {{$product->min_sale_quantity}}, tối đa {{$product->max_sale_quantity}}"
                                                       required="">
                                            </div>
                                        </div>
                                        @if($product->type == \App\Enums\ProductType::BY_TIME)
                                            <div class="mb-3">
                                                <h6 class="mb-3">Nhập thời gian chạy (phút) <span
                                                            class="text-danger">*</span></h6>
                                                <div class="input-group">
                                                    <input type="number" class="form-control"
                                                           min="30"
                                                           name="execution_time" value="{{ old('execution_time')}}"
                                                           placeholder="Tối thiểu 30"
                                                           required>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <h6 class="mb-3">Ghi chú <em class="text-warning fs-12">(Nếu là dịch vụ cần
                                                    comment viết mỗi câu 1 dòng)</em></h6>
                                            <div class="input-group">
                                            <textarea name="note" class="form-control" cols="30" rows="10">
                                                {{ old('note')}}
                                            </textarea>
                                            </div>
                                        </div>
                                        <hr class="mb-4">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">
                                            Thanh toán
                                        </button>
                                    </form>
                                </div>
                            @else
                                <p class="text-warning text-center">Dịch vụ đang bảo trì</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom-style')
@endpush
@push('custom-scripts')
@endpush
