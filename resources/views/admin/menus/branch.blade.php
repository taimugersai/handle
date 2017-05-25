<ol class="dd-list">
    @foreach($menus as $menu)
    <li class="dd-item" data-id="{{ $menu->id }}">
        <div class="dd-handle">
            <i class="{{ $menu->icon }}"></i>
            {{ $menu->display_name }}
            <a href="">{{ $menu->name }}</a>
        </div>
        <div class="action">
            <a href="{{ route('menu.edit', $menu->id) }}"><i class="glyphicon glyphicon-edit"></i></a>
            <a data-attr="{{ $menu->id }}" class="delBtn"><i class="glyphicon glyphicon-trash"></i></a>
        </div>
        @if(count($menu->children))
            @include('admin.menus.branch', ['menus' => $menu->children])
        @endif
    </li>
    @endforeach
</ol>