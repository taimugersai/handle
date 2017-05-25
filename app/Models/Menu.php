<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['parent_id', 'display_name', 'icon', 'name', 'desc'];

    /**
     * 下级菜单
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * 排序
     *
     * @param $serialize
     * @param int $parent_id
     */
    public static function order($serialize, $parent_id = 0)
    {
        foreach ($serialize as $key => $value) {
            self::where('id', $value['id'])->update(['order' => $key, 'parent_id' => $parent_id]);
            if(isset($value['children'])) {
                self::order($value['children'], $value['id']);
            }
        }
    }

    public static function getParents($value, $tmp = [], $key='name')
    {
        $menu = self::where($key, $value)->first();
        if($menu) {
            array_push($tmp, $menu->id);
            if($menu->parent_id>0) {
                return self::getParents($menu->parent_id, $tmp, 'id');
            }
            return $tmp;
        }else {
            return $tmp;
        }
    }
}
