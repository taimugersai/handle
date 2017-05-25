@foreach($menus as $menu)
    <li class="treeview @if(in_array($menu->id, $current)) active @endif">
        <a href="{{ empty($menu->name)?'#':route($menu->name) }}">
            <i class="{{ $menu->icon }}"></i>
            <span>{{ $menu->display_name }}</span>
            @if(count($menu->children))
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
            @endif
        </a>
        @if(count($menu->children))
            <ul class="treeview-menu">
                @include('admin.layouts._slider_branch', ['menus' => $menu->children])
            </ul>
        @endif
    </li>
@endforeach