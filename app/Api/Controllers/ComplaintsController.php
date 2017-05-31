<?php

namespace App\Api\Controllers;
use App\Api\Requests\ComplaintRequest;
use App\Api\Requests\ReasonRequest;
use App\Models\User;
use App\Models\Complaint;
use App\Models\PublicToilet;
use App\Models\GoalGass;
use App\Models\DeliverWater;
use App\Models\HouseMoving;
use App\Models\Recovery;
use App\Models\Rental;
use App\Models\Unlock;
use App\Models\Reason;
class ComplaintsController extends BaseController
{
	public function publish(ComplaintRequest $request){
		//获取数据 存入数据
		$userInfo = User::where('openid', $request->get('id'))->first();
		$complaint = new Complaint;
		$complaint->user_id = $userInfo->id;
		$res = Reason::findOrFail($request->get('reasons'));
		$complaint->reasons = $res->reasons;
		$complaint->detail = $request->get('detail');
        $complaint->common_id = $request->get('common_id');
        $complaint->common_type = $this->type($request->get('common_type'));
		\DB::beginTransaction();
		try{
			$complaint->save();
		}catch(\Exception $error){
			\DB::rollback();
			return $this->response->errorInternal();
		}
        \DB::commit();
        return $this->response->created();
	}

    protected function type($type)
    {
        $arr = [
            '1' => PublicToilet::class,
            '2' => GoalGass::class,
            '3' => DeliverWater::class,
            '4' => HouseMoving::class,
            '5' => Recovery::class,
            '6' => Rental::class,
            '7' => Unlock::class
        ];
        return $arr[$type];
	}
	public function getReasons(ReasonRequest $request){
        $index = $request->get('common_type');
        $type = $this->type($index);
        $list = Reason::where('common_type',$type)->select('id','reasons')->get();
        return $list;
    }
}