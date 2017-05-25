<?php

namespace App\Http\ViewComposers;

use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

class MenuComposer
{
    /**
     * 绑定数据到视图.
     *
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $menus = Menu::where('parent_id', 0)->get();
        $current = Menu::getParents(Route::currentRouteName());
        $view->with(compact('menus', 'current'));
    }
}