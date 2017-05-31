<?php

namespace App\Api\Controllers;

use App\Api\Requests\UnlockRequest;
use App\Models\Img;
use App\Models\Keyword;
use App\Models\Unlock;
use App\Models\User;
use App\Api\TransFormers\UnlockTransformer;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class UnlockController extends BaseController
{

    /**
     * 开锁列表
     * @param UnlockRequest $request
     * @return \Dingo\Api\Http\Response
     */
    public function index(UnlockRequest $request)
    {
        $longitude = $request->get('longitude');
        $latitude = $request->get('latitude');
        $pageNow = $request->get('page', 1);
        $pageSize = 10;
        $where = [
            ['status', 1]
        ];
        $list = app(Unlock::class)->getNearLists($longitude, $latitude, $where);
        $list = new LengthAwarePaginator($list->forPage($pageNow, $pageSize), $list->count(), $pageSize);
        return $this->response->paginator($list, new UnlockTransformer);
    }

    public function publish(UnlockRequest $request)
    {
        $userInfo = User::where('openid', $request->get('id'))->first();
        $ins = new Unlock();
        $ins->user_id = $userInfo->id;
        $ins->name = $request->get('name');
        $ins->address = $request->get('address');
        $ins->longitude = $request->get('longitude');
        $ins->latitude = $request->get('latitude');
        $ins->phone = $request->get('phone');

        \DB::beginTransaction();
        try {
            $ins->save();
        } catch (\Exception $error) {
            \DB::rollBack();
            return $this->response->errorInternal();
        }

        # 添加关键字
        try {
            Keyword::insert([
                'content' => $ins->name,
                'common_id' => $ins->id,
                'common_type' => Unlock::class,
                'created_at' => Carbon::now()
            ]);
        } catch (\Exception $error) {
            \DB::rollBack();
            return $this->response->errorInternal();
        }

        # 上传文件
        $imgId = $request->get('img');
        $tmpIns = Img::findOrFail($imgId);
        $tmpIns->common_id = $ins->id;
        $tmpIns->common_type = Unlock::class;
        try {
            $tmpIns->save();
        } catch (\Exception $error) {
            \DB::rollBack();
            return $this->response->errorInternal();
        }

        \DB::commit();
        return $this->response->created();
    }


}