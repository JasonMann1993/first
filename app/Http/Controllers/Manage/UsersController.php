<?php

namespace App\Http\Controllers\Manage;

use App\Http\Requests\Manage\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends BaseController
{
    //用户列表页
    public function index(Request $request){
    	$where = [];
    	if($tmpInput = $request->get('name'));
    	 array_push($where, ['name', 'like', '%' . $tmpInput . '%']);
        if ($tmpInput = $request->get('openid'))
            array_push($where, ['openid', 'like', '%' . $tmpInput . '%']);
    	$lists = User::latest('id')->where($where)->paginate(10);
    	return view('manage.users.index',['lists'=>$lists]);
    }

    /**
     * 显示
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $info = User::findOrFail($id);

        return view('manage.users.show', compact('info'));
    }

    /**
     * 用户登陆
     */
    public function login(UserRequest $request)
    {
        $member = [
            'name' => 'admin',
            'password' => '123456'
        ];
        # 检查用户是否登陆
        if(!auth()->check()){
            if ($request->get('name') != $member['name']){
                session()->flash('error','用户不存在');
                return back()->withInput();
            }
            if ($request->get('password') != $member['password']){
                session()->flash('error','密码错误');
                return back()->withInput();
            }
            auth()->loginUsingId(1);
        }
        return redirect()->action('Manage\Home\IndexController@index');
    }

    /**
     * 登陆页面
     */
    public function loginPage()
    {
        return view('manage.users.login');
    }
}
