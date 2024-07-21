@foreach(config('menu-admin') as $menuItem)
    @if(isset($menuItem['children']) && $menuItem['children'])
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{Route::is(explode('|',$menuItem['activeIs']))?'show':''}}">
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="{{$menuItem['icon']}}"></i>
                </span>
                <span class="menu-title">{{$menuItem['text']}}</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion menu-active-bg">
                @foreach($menuItem['children'] as $child)
                    <div class="menu-item">
                        <a class="menu-link {{Route::is(explode('|',$child['activeIs']))?'active':''}}"
                           href="{{route($child['route'])}}">
                            <span class="menu-bullet">
                                <i class="{{$child['icon']}}"></i>
                            </span>
                            <span class="menu-title">{{$child['text']}}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="menu-item">
            <a class="menu-link {{Route::is(explode('|',$menuItem['activeIs']))?'active':''}}"
               href="{{route($menuItem['route'])}}">
        <span class="menu-icon">
            <i class="{{$menuItem['icon']}}"></i>
        </span>
                <span class="menu-title">{{$menuItem['text']}}</span>
            </a>
        </div>
    @endif
@endforeach
