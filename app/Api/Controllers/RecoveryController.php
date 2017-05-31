<?php

namespace App\Api\Controllers;

use App\Api\Requests\RecoveryRequest;
use App\Models\Img;
use App\Models\Keyword;
use App\Models\User;
use App\Models\Recovery;
use App\Api\TransFormers\RecoveryTransformer;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class RecoveryController extends BaseController
{

    public function index(RecoveryRequest $request)
    {
        $longitude = $request->get('longitude');
        $latitude = $request->get('latitude');
        $pageNow = $request->get('page', 1);
        $pageSize = 10;

        $where = [
            ['status', 1], // 0待审核1审核通过2驳回3垃圾信息
        ];
        $list = app(Recovery::class)->getNearLists($longitude, $latitude, $where);
        $list = new LengthAwarePaginator($list->forPage($pageNow, $pageSize), $list->count(), $pageSize);
        return $this->response->paginator($list, new RecoveryTransformer);
    }

    public function publish(RecoveryRequest $request)
    {
        $userInfo = User::where('openid', $request->get('id'))->first();
        $ins = new Recovery();
        $ins->user_id = $userInfo->id;
        $ins->name = $request->get('name');
        $ins->address = $request->get('address');
        $ins->longitude = $request->get('longitude');
        $ins->latitude = $request->get('latitude');
        $ins->phone = $request->get('phone');
        $ins->save();
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
                'common_type' => Recovery::class,
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
        $tmpIns->common_type = Recovery::class;
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