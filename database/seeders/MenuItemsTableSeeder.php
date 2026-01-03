<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu_items')->delete();
        
        \DB::table('menu_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'label' => 'Shop',
                'link' => 'shop',
                'parent' => 0,
                'sort' => 0,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
                'local' => 1,
                'development' => 1,
                'stage' => 0,
                'production' => 0,
                'marketing' => 0,
                'logged_in_only' => 0,
                'role_id' => 0,
                'icon_only_menu' => 0,
                'menu_icon_class' => NULL,
                'created_at' => '2026-01-02 01:50:53',
                'updated_at' => '2026-01-02 01:59:50',
            ),
            1 => 
            array (
                'id' => 2,
                'label' => 'Account',
                'link' => 'home',
                'parent' => 0,
                'sort' => 1,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
                'local' => 1,
                'development' => 1,
                'stage' => 0,
                'production' => 0,
                'marketing' => 0,
                'logged_in_only' => 0,
                'role_id' => 0,
                'icon_only_menu' => 0,
                'menu_icon_class' => NULL,
                'created_at' => '2026-01-02 01:59:46',
                'updated_at' => '2026-01-02 22:07:01',
            ),
            2 => 
            array (
                'id' => 3,
                'label' => 'Bamboo',
                'link' => '/shop?category=6',
                'parent' => 4,
                'sort' => 1,
                'class' => NULL,
                'menu' => 5,
                'depth' => 1,
                'local' => 1,
                'development' => 1,
                'stage' => 0,
                'production' => 0,
                'marketing' => 0,
                'logged_in_only' => 0,
                'role_id' => 0,
                'icon_only_menu' => 0,
                'menu_icon_class' => NULL,
                'created_at' => '2026-01-02 02:44:19',
                'updated_at' => '2026-01-02 02:44:51',
            ),
            3 => 
            array (
                'id' => 4,
                'label' => 'Specialty',
                'link' => '/shop?category=9',
                'parent' => 0,
                'sort' => 0,
                'class' => NULL,
                'menu' => 5,
                'depth' => 0,
                'local' => 1,
                'development' => 1,
                'stage' => 0,
                'production' => 0,
                'marketing' => 0,
                'logged_in_only' => 0,
                'role_id' => 0,
                'icon_only_menu' => 0,
                'menu_icon_class' => NULL,
                'created_at' => '2026-01-02 02:44:44',
                'updated_at' => '2026-01-02 02:44:47',
            ),
            4 => 
            array (
                'id' => 5,
                'label' => 'Supplies',
                'link' => '/shop?category=8',
                'parent' => 0,
                'sort' => 2,
                'class' => NULL,
                'menu' => 5,
                'depth' => 0,
                'local' => 1,
                'development' => 1,
                'stage' => 0,
                'production' => 0,
                'marketing' => 0,
                'logged_in_only' => 0,
                'role_id' => 0,
                'icon_only_menu' => 0,
                'menu_icon_class' => NULL,
                'created_at' => '2026-01-02 17:53:38',
                'updated_at' => '2026-01-02 17:53:38',
            ),
            5 => 
            array (
                'id' => 6,
                'label' => '|',
                'link' => '#divider-h',
                'parent' => 0,
                'sort' => 2,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
                'local' => 1,
                'development' => 1,
                'stage' => 0,
                'production' => 0,
                'marketing' => 0,
                'logged_in_only' => 0,
                'role_id' => 1,
                'icon_only_menu' => 0,
                'menu_icon_class' => NULL,
                'created_at' => '2026-01-02 22:03:58',
                'updated_at' => '2026-01-02 22:03:58',
            ),
            6 => 
            array (
                'id' => 7,
                'label' => 'Admin',
                'link' => 'admin',
                'parent' => 0,
                'sort' => 3,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
                'local' => 1,
                'development' => 1,
                'stage' => 0,
                'production' => 0,
                'marketing' => 0,
                'logged_in_only' => 0,
                'role_id' => 1,
                'icon_only_menu' => 0,
                'menu_icon_class' => NULL,
                'created_at' => '2026-01-02 22:04:14',
                'updated_at' => '2026-01-02 22:04:14',
            ),
        ));
        
        
    }
}