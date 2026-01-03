<?php

namespace Wecodelaravel\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{

    protected $table = null;

    protected $fillable = ['label', 'link', 'parent', 'sort', 'class', 'menu', 'depth', 'role_id', 'icon_only_menu', 'menu_icon_class', 'logged_in_only'];

    public function __construct(array $attributes = [])
    {
        //parent::construct( $attributes );
        $this->table = config('menu.table_prefix') . config('menu.table_name_items');
    }

    public function getsons($id)
    {
        return $this->where("parent", $id)->get();
    }
    public function getall($id)
    {
        return $this->where("menu", $id)->orderBy("sort", "asc")->get();
    }

    public static function getNextSortRoot($menu)
    {
        return self::where('menu', $menu)->max('sort') + 1;
    }

    public function parent_menu()
    {
        return $this->belongsTo('Wecodelaravel\Menu\Models\Menus', 'menu');
    }

    public function child()
    {
        return $this->hasMany('Wecodelaravel\Menu\Models\MenuItems', 'parent')->orderBy('sort', 'ASC');
    }
}
