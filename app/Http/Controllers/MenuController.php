<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('order');
    }
    
    public function index()
    {
        $menus = Menu::where('parent_id', 0)->orderBy('order')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $menu = Menu::create($data);
        flash('添加菜单成功','success');
        return redirect(route('menu.index'));
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $menus = $menus = Menu::where('parent_id', 0)->orderBy('order')->get();
        return view('admin.menus.edit', compact('menu', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $menu = Menu::findOrFail($id);
        $menu->parent_id = $data['parent_id'];
        $menu->display_name = $data['display_name'];
        $menu->icon = $data['icon'];
        $menu->name = $data['name'];
        $menu->save();
        flash('编辑菜单成功','success');
        return redirect(route('menu.index'));
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        if(count($menu->children)) {
            flash('请先删除子菜单','danger');
        }else {
            $menu->delete();
            flash('删除菜单成功','success');
        }
        return redirect(route('menu.index'));
    }

    public function order(Request $request)
    {
        $serialize = $request->get('serialize');
        Menu::order($serialize);
        return response()->json(['responseCode' => 1, 'responseMsg' => '排序成功']);
    }
}
