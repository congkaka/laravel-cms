@extends('themes.owlio.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="form-head d-flex flex-wrap mb-sm-4 align-items-start">
            <div class="me-auto mb-2 d-lg-block mb-3">
                <h2 class="text-black font-w700 mb-0">Dịch vụ</h2>
            </div>
        </div>
        @foreach($categories as $c)
            <div class="row">
                <div class="col-12">
                    <h2>{{$c->name}}</h2>
                </div>
                @foreach($c->products as $p)
                    <div class="col-xl-3 col-xxl-6 col-sm-6">
                        <a href="{{route('checkout', $p->id)}}">
                            <div class="card contact-bx hvr">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="image-bx me-3">
                                            <img src="{{asset($p->image)}}" alt="" class="rounded-circle" width="90">
                                            <span class="active"></span>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="font-w700">
                                                {{$p->name}}
                                            </h6>
                                            @if(!$p->is_active)
                                                <p class="fs-14 mb-1 text-warning">(Bảo trì)</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
@push('custom-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lấy múi giờ của client
            var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

            // Gửi múi giờ về server bằng AJAX
            fetch("{{route('set_timezone')}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ timezone: timezone })
            });
        });
    </script>

@endpush
