@php
    $setting = \App\Models\SiteSetting::first();
@endphp
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="javascript:void(0)" class="ai-icon" aria-expanded="false">
                    <span class="nav-text text-black">Settings</span>
                </a>
            </li>
            <li>
                <a href="{{route('list-user')}}" class="ai-icon" aria-expanded="false">
                    <i class="ti-user"></i>
                    <span class="nav-text">Users</span>
                </a>
            </li>
            
            
        </ul>
        <div class="copyright">
            <p><strong>Hỗ trợ khách hàng</strong></p>
            @if(isset($setting['phone']))
            <p>Điện thoại: <a class="text-primary" href="tel:{{$setting['phone']}}" target="_blank">{{$setting['phone']}}</a></p>
            @endif
            @if(isset($setting['zalo']))
            <p>Zalo: <a class="text-primary" href="https://zalo.me/{{$setting['zalo']}}" target="_blank">{{$setting['zalo']}}</a></p>
            @endif
        </div>
    </div>
</div>
