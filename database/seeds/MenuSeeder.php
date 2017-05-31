<?php

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
        $time=\Carbon\Carbon::now();
        $menus = [
            ['id' => 1, 'name' => '菜单列表', 'parent_id' => 0, 'sort' => 100,'url' => '/manage/menu', 'icon' => 'window-restore', 'created_at' => $time],
            ['id' => 2, 'name' => '类型管理', 'parent_id' => 0, 'sort' => 50, 'url' => '/manage/menu', 'icon' => 'sitemap', 'created_at' => $time],
            ['id' => 3, 'name' => '送水管理', 'parent_id' => 2, 'sort' => 50, 'url' => '/manage/DeliverWater', 'icon' => 'bandcamp', 'created_at' => $time],
            ['id' => 7, 'name' => '搬家管理', 'parent_id' => 2, 'sort' => 50, 'url' => '/manage/service/HouseMove', 'icon' => 'bars', 'created_at' => $time],
            ['id' => 8, 'name' => '煤气管理', 'parent_id' => 2, 'sort' => 50, 'url' => '/manage/CoalGas', 'icon' => 'exclamation-triangle', 'created_at' => $time],
            ['id' => 9, 'name' => '用户管理', 'parent_id' => 0, 'sort' => 50, 'url' => '/manage/users', 'icon' => 'user', 'created_at' => $time],
            ['id' => 10,'name' => '投诉管理', 'parent_id' => 0, 'sort' => 50, 'url' => '/manage/menu', 'icon' => 'volume-control-phone', 'created_at' => $time],
            ['id' => 11,'name' => '回收管理', 'parent_id' => 2, 'sort' => 50, 'url' => '/manage/Recovery', 'icon' => 'trash-o', 'created_at' => $time],
            ['id' => 12,'name' => '开锁管理', 'parent_id' => 2, 'sort' => 50, 'url' => '/manage/Unlock', 'icon' => 'unlock', 'created_at' => $time],
            ['id' => 13,'name' => '公厕管理', 'parent_id' => 2, 'sort' => 50, 'url' => '/manage/PublicToilet', 'icon' => 'user-circle', 'created_at' => $time],
            ['id' => 14,'name' => '租房管理', 'parent_id' => 2, 'sort' => 50, 'url' => '/manage/service/Rental', 'icon' => 'university', 'created_at' => $time],
            ['id' => 15,'name' => '投诉列表', 'parent_id' => 10, 'sort' => 50, 'url' => '/manage/complaints', 'icon' => 'volume-control-phone', 'created_at' => $time],
            ['id' => 16,'name' => '投诉原因', 'parent_id' => 10, 'sort' => 50, 'url' => '/manage/reasons', 'icon' => 'volume-control-phone', 'created_at' => $time],
        ];
        DB::table('menus')->truncate();
        DB::table('menus')->insert($menus);
        //
    }
}
