@extends('admin.admin')
@section('title','菜单管理')
@section('summary','菜单管理')
@section('desc','菜单列表')
@section('header')
    <link rel="stylesheet" href="/plugins/Bootstrap-icon-picker/css/icon-picker.min.css">
    <style>
        .dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
        .dd-list .dd-list { padding-left: 30px; }
        .dd-collapsed .dd-list { display: none; }
        .dd-item,
        .dd-empty,
        .dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }
        .dd-handle {
            display: block;
            height: 30px;
            margin: 5px 0;
            padding: 5px 10px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #ccc;
            background: #fafafa;
            background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
            background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
            background:         linear-gradient(top, #fafafa 0%, #eee 100%);
            -webkit-border-radius: 3px;
            border-radius: 3px;
            box-sizing: border-box; -moz-box-sizing: border-box;
        }
        .dd-handle:hover { color: #2ea8e5; background: #fff; }
        .action {
            position: absolute;
            top:5px;
            right:5px;
        }
        .dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
        .dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
        .dd-item > button[data-action="collapse"]:before { content: '-'; }
        .dd-placeholder,
        .dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
        .dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
            background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
            linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
            background-size: 60px 60px;
            background-position: 0 0, 30px 30px;
        }
        .dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
        .dd-dragel > .dd-item .dd-handle { margin-top: 0; }
        .dd-dragel .dd-handle {
            -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
        }
        /**
         * Nestable Extras
         */
        #nestable-menu {
            /* margin-left: 0; */
            padding-left: 0;
        }
        .nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0; border-top: 2px solid #ddd; border-bottom: 2px solid #ddd; }
        .dd-hover > .dd-handle { background: #2ea8e5 !important; }
    </style>
@endsection
@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">菜单管理</h3>
        <span class="text-primary">温馨提示：最多支持到二级菜单(排序按从大到小)</span>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <menu id="nestable-menu">
                        <button type="button" class="btn btn-info" data-action="expand-all">展开</button>
                        <button type="button" class="btn btn-primary" data-action="collapse-all">收起</button>
                        <button type="button" class="btn btn-success" data-action="order">排序</button>
                    </menu>
                    <div class="dd">
                        @include('admin.menus.branch', compact('menus'))
                    </div>
                </div>
                <div class="col-md-4 col-md-offset-1">
                    <form action="{{ route('menu.store') }}" method="post" class="form-horizontal">
                        {!! csrf_field() !!}
                        @include('admin.layouts.form._tree', ['name' => 'parent_id', 'label' => '父级', 'belongsTo' => $menus, 'value' => '0', 'key' => 'id', 'val' => 'display_name'] )
                        <div class="form-group">
                            <label for="display_name" class="control-label">菜单名称</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                <input type="text" name="display_name" value="{{ old('display_name') }}" class="form-control"
                                       placeholder="请输入菜单名" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="icon" class="control-label">图标</label>
                            <input type="text" name="icon" class="icon-picker form-control" />
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label">路由名称</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                       placeholder="请输入路由名称">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label">简介</label>
                            <textarea name="desc"  class="form-control" placeholder="请输入简介"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="btn-group pull-right">
                                <button type="submit" class="btn btn-info pull-right">提交</button>
                            </div>
                            <div class="btn-group pull-left">
                                <input type="reset" class="btn btn-warning" value="撤销">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-delete" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    ×
                </button>
                <h4 class="modal-title">提示</h4>
            </div>
            <div class="modal-body">
                <p class="lead">
                    <i class="fa fa-question-circle fa-lg"></i>
                    确认要删除这个菜单吗?
                </p>
            </div>
            <div class="modal-footer">
                <form class="deleteForm" method="POST" action="#">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-times-circle"></i>确认
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script src="/plugins/Nestable/jquery.nestable.js"></script>
    <script src="/plugins/Bootstrap-icon-picker/js/iconPicker.min.js"></script>
    <script>
        $(".icon-picker").iconPicker();
        var $dd = $(".dd");
        $dd.nestable().delegate('.delBtn', 'click', function () {
            var id = $(this).attr('data-attr');
            $('.deleteForm').attr('action', '/admin/menu/' + id);
            $("#modal-delete").modal();
        });
        $('#nestable-menu').on('click', function(e) {
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
            if(action === 'order') {
                $.post('{{ route('menu.order') }}', {serialize:$dd.nestable('serialize')}, function(result) {
                    if(result.responseCode == 1) {
                        alert(result.responseMsg);
                    }
                });
            }
        });
    </script>
@endsection