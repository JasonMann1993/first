<?php

namespace App\Api\Controllers;

use App\Api\Requests\RentalRequest;
use App\Models\Img;
use App\Models\Keyword;
use App\Models\User;
use App\Models\Rental;
use App\Api\TransFormers\RentalTransformer;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class RentalController extends BaseController
{

    public function index(RentalRequest $request)
    {
        $longitude = $request->get('longitude');
        $latitude = $request->get('latitude');
        $pageNow = $request->get('page', 1);
        $pageSize = 10;

        $where = [
            ['status', 1], // 0待审核1审核通过2驳回3垃圾信息
        ];
        $list = app(Rental::class)->getNearLists($longitude, $latitude, $where);
        $list = new LengthAwarePaginator($list->forPage($pageNow, $pageSize), $list->count(), $pageSize);
        return $this->response->paginator($list, new RentalTransformer);
    }

    public function publish(RentalRequest $request)
    {
        $userInfo = User::where('openid', $request->get('id'))->first();
        $ins = new Rental();
        $ins->user_id = $userInfo->id;
        //$ins->name = $request->get('name');
        $ins->cell_name = $request->get('cell_name');
        $ins->size = $request->get('size');
        $ins->address = $request->get('address');
        $ins->longitude = $request->get('longitude');
        $ins->latitude = $request->get('latitude');
        $ins->phone = $request->get('phone');
        $ins->form = $request->get('form');
        $ins->price = $request->get('price');
        $ins->require = $request->get('require');

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
                'content' => $ins->cell_name,
                'common_id' => $ins->id,
                'common_type' => Rental::class,
                'created_at' => Carbon::now()
            ]);
        } catch (\Exception $error) {
            \DB::rollBack();
            return $this->response->errorInternal();
        }

        # 上传文件
        foreach ($request->get('img') as $v) {
            $tmpIns = Img::findOrFail($v);
            $tmpIns->common_id = $ins->id;
            $tmpIns->common_type = rental::class;
            try {
                $tmpIns->save();
            } catch (\Exception $error) {
                \DB::rollBack();
                return $this->response->errorInternal();
            }
        }

        \DB::commit();
        return $this->response->created();
    }
}