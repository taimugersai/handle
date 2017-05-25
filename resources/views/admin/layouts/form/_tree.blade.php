<div class="form-group">
    <label for="{{ $name }}" class="control-label">{{ $label }}</label>
    <select class="form-control" name="{{ $name }}" id="{{ $name }}">
        <option value="0">Root</option>
        @include('admin.layouts.form._tree_branch', ['tree' => $belongsTo, 'level' => 0])
    </select>
</div>