<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function __construct(Request $request)
    {
        # 获得Menus
        view()->share('menuLists', $this->getMenus());
    }

    /**
     * 获取菜单
     * @return mixed
     */
    protected function getMenus()
    {
        $lists = Menu::latest('sort')->get();
        $lists = recursive_child($lists);
        return $lists;
    }

    public function rollback($error = null, $url = null)
    {
        \DB::rollBack();
        session()->flash('error', $error ? $error : '操作失败');
        if ($url)
            return $url;
        return true;
    }

    public function success($info = null, $url = null)
    {
        session()->flash('success', $info ? $info : '操作成功');
        if ($url)
            return $url;
        return true;
    }
}


