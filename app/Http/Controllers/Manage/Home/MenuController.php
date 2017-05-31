<?php

namespace App\Http\Controllers\Manage\Home;

use App\Http\Controllers\Manage\BaseController;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $where = [];
        if ($tmpInput = $request->get('name'))
            array_push($where, ['name', 'like', '%' . $tmpInput . '%']);
        if ($tmpInput = $request->get('url'))
            array_push($where, ['url', 'like', '%' . $tmpInput . '%']);

        $lists = Menu::latest('sort')->where($where)->get();
        $lists = recursive_sort($lists);
        return view('manage.home.menu.index', compact('lists'));
    }


}
