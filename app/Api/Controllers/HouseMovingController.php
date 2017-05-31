<?php

namespace App\Api\Controllers;
use App\Api\Requests\HouseMovingRequest;
use App\Models\HouseMoving;
use App\Models\Img;
use App\Models\Keyword;
use App\Models\User;
use Carbon\Carbon;
use App\Api\TransFormers\HouseMovingTransformer;
use Illuminate\Pagination\LengthAwarePaginator;

class HouseMovingController extends BaseController
{

    public function index(HouseMovingRequest $request)
    {
        $longitude = $request->get('longitude');
        $latitude = $request->get('latitude');
        $pageNow = $request->get('page', 1);
        $pageSize = 10;

        $where = [
            ['status', 1], // 0待审核1审核通过2驳回3垃圾信息
        ];
        $list = app(HouseMoving::class)->getNearLists($longitude, $latitude, $where);
        $list = new LengthAwarePaginator($list->forPage($pageNow, $pageSize), $list->count(), $pageSize);
        return $this->response->paginator($list, new HouseMovingTransformer());
    }


    public function publish(HouseMovingRequest $request)
    {
        $userInfo = User::where('openid', $request->get('id'))->first();
        $ins = new HouseMoving();
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
                'common_type' => HouseMoving::class,
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
        $tmpIns->common_type = HouseMoving::class;
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