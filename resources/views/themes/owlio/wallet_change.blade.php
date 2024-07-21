@extends('themes.owlio.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Lịch sử ví</h4>
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
                                    <th class="align-middle">Thời gian</th>
                                    <th class="align-middle">Trước thay đổi</th>
                                    <th class="align-middle pe-7">Thay đổi</th>
                                    <th class="align-middle pe-7">Sau thay đổi</th>
                                    <th class="align-middle">Nội dung</th>
                                </tr>
                                </thead>
                                <tbody id="orders">
                                @foreach($walletChanges as $c)
                                    <tr class="btn-reveal-trigger">
                                        <td class="py-2">{{toClientTime($c->created_at)}}</td>
                                        <td class="py-2">{{$c->wallet_pre}}</td>
                                        <td class="py-2">
                                            <span class="{{$c->is_plus ? 'text-success' : 'text-danger'}}">{{$c->is_plus ? '+' : '-'}}{{$c->wallet_change}}</span>
                                        </td>
                                        <td class="py-2">{{$c->wallet_after}}</td>
                                        <td class="py-2">{!! $c->content !!}</td>
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
            {{ $walletChanges->appends($_GET)->links('admin.custom.pagination')}}
        </div>
    </div>
@endsection
@push('custom-scripts')
@endpush
