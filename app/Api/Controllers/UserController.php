<?php

namespace App\Api\Controllers;

use App\Api\Requests\UserRequest;
use App\Models\User;
use GuzzleHttp\Client;
use Psy\Util\Json;

class UserController extends BaseController
{
    /**
     * 处理添加用户
     *
     * @param UserRequest $request
     * @return \Dingo\Api\Http\Response|void
     */
    public function handleUser(UserRequest $request)
    {
        # 检查用户是否存在
        $userIns = new User();
        $user = $userIns->where([
            'openid' => $request->get('openid')
        ])->first();
        # 添加用户到表中
        if (!$user) {
            $userIns->openid = $request->get('openid');
            $userIns->name = $request->get('name');
            $userIns->avatar = $request->get('avatar');
            $userIns->sex = $request->get('gender');
            try {
                \DB::beginTransaction();
                $userIns->save();
                ## 添加用户详细信息到表中
                $userIns->info()->create([
                    'content' => Json::encode($request->get('info'))
                ]);
            }catch(\Exception $error){
                \DB::rollBack();
                return $this->response()->errorInternal();
            }
            \DB::commit();
            return $this->response->created();
        }
        return $this->response->noContent();
    }
    /**
     * 获取用户OPENID
     * @param UserRequest $request
     * @return array|void
     */
    public function getOpenid(UserRequest $request)
    {
        $url = 'https://api.weixin.qq.com/sns/jscode2session?';
        $url .= http_build_query([
            'appid' => env('S_WECHAT_APPID'),
            'secret' => env('S_WECHAT_SECRET'),
            'js_code' => $request->get('code'),
            'grant_type' => 'authorization_code'
        ]);
        $client = new Client();
        $res = $client->request('get', $url);
        $userRes = $res->getBody()->getContents();
        $userRes = \GuzzleHttp\json_decode($userRes);
        $userRes = collect($userRes);
        if ($openid = $userRes->get('openid'))
            return ['openid' => $openid];
        return $this->response()->errorInternal();
    }
}