@extends('admin.admin')
@section('title','菜单管理')
@section('summary','菜单管理')
@section('desc','编辑菜单')

@section('header')
    <link rel="stylesheet" href="/plugins/Bootstrap-icon-picker/css/icon-picker.min.css">
@endsection
@section('content')
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">编辑</h3>
            <div class="box-tools">
                <div class="btn-group pull-right" style="margin-right: 10px">
                    <a href="{{ route('menu.index') }}" class="btn btn-sm btn-default">
                        <i class="fa fa-list"></i>&nbsp;列表
                    </a>
                </div>
                <div class="btn-group pull-right" style="margin-right: 10px">
                    <a href="javascript:history.go(-1);" class="btn btn-sm btn-default">
                        <i class="fa fa-arrow-left"></i>&nbsp;返回
                    </a>
                </div>
            </div>
        </div>
        <div class="box-body">
            <form action="{{ route('menu.update', $menu->id) }}" method="post" class="form-horizontal">
                {!! csrf_field() !!}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="parent_id" class="col-md-3 control-label">父级</label>
                    <div class="col-md-6 input-group">
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="0">Root</option>
                            @include('admin.layouts.form._tree_branch', ['tree' => $menus, 'level' => 0, 'value'=>old('parent_id', $menu->parent_id), 'key'=>'id', 'val' => 'display_name'])
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="display_name" class="col-md-3 control-label">菜单名称</label>
                    <div class="col-md-6 input-group">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <input type="text" name="display_name" value="{{ old('display_name', $menu->display_name) }}" class="form-control"
                               placeholder="请输入菜单名" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="icon" class="col-md-3 control-label">图标</label>
                    <div class="col-md-6 input-group">
                        <input type="text" name="icon" class="icon-picker" value="{{ old('icon', $menu->icon) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">路由名称</label>
                    <div class="col-md-6 input-group">
                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                        <input type="text" name="name" value="{{ old('name', $menu->name) }}" class="form-control"
                               placeholder="请输入路由名称">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">简介</label>
                    <div class="col-md-6 input-group">
                        <textarea name="desc"  class="form-control" placeholder="请输入简介">{{ old('desc', $menu->desc) }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-6">
                        <div class="btn-group pull-right">
                            <button type="submit" class="btn btn-info pull-right">保存</button>
                        </div>
                        <div class="btn-group pull-left">
                            <input type="reset" class="btn btn-warning" value="撤销">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <script src="/plugins/Bootstrap-icon-picker/js/iconPicker.min.js"></script>
    <script>
        $(function () {
            $(".icon-picker").iconPicker();
        });
    </script>
@endsection