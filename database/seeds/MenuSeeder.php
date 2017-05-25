<?php

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'parent_id' => 0,
                'display_name' => '系统菜单',
                'icon' => 'glyphicon glyphicon-cog',
                'name' => '',
                'desc' => '系统相关操作菜单'
            ],
            [
                'parent_id' => 1,
                'display_name' => '菜单管理',
                'icon' => 'glyphicon glyphicon-th-list',
                'name' => 'menu.index',
                'desc' => '后台菜单管理'
            ]
        ];
        Menu::insert($menus);
    }
}
