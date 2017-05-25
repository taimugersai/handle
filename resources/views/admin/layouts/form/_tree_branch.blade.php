<?php
    $level++
?>
@foreach($tree as $leaf)
    <option value="{{ $leaf->{$key} }}" @if($value == $leaf->{$key}) selected @endif>
        @for($i=0;$i<$level;$i++)
            &nbsp;&nbsp;&nbsp;&nbsp;
        @endfor
        |--{{ $leaf->{$val} }}
    </option>
    @if(count($leaf->children))
        @include('admin.layouts.form._tree_branch', ['tree' => $leaf->children, 'level' => $level])
    @endif
@endforeach