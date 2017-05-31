<?php

namespace App\Http\Controllers\Manage\Home;

use App\Http\Controllers\Manage\BaseController;

class IndexController extends BaseController
{
    public function index()
    {
        $txt = '便民小助手 ';

        return view('manage/home/index')->with(compact('txt'));
    }
}
