<?php
namespace App\Api\Controllers;
use App\Models\Like;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Rental;
use App\Api\TransFormers\LikeTransformer;
use App\Api\Requests\LikeRequest;
class LikeController extends BaseController
{
    //添加用户喜欢
    public function audit(LikeRequest $request){
        $userInfo = User::where('openid', $request->get('id'))->first();

        $likes=new like();
        $likes->user_id=$userInfo->id;
        $likes->created_at=date('Y-m-d H:i:s',time());
        $common_id=$request->get('common_id');
        //查询该订单是否已经标明喜欢
        $like_list=Like::where(['user_id'=>$userInfo->id,'common_type'=>'App\Models\Rental','common_id'=>$common_id])->first();
        if(!empty($like_list)){
            if($like_list['status']==1){
                $up_like=Like::findOrFail($like_list['id']);
                $up_like->status=2;
                $up_like->save();
               return $this->response->item($up_like,new  LikeTransformer());

            }elseif($like_list['status']=2){
                $up_like=Like::findOrFail($like_list['id']);
                $up_like->status=1;
                $up_like->save();
                return $this->response->item($up_like, new  LikeTransformer());
            }

        }

        $likes->common_type='App\Models\Rental';//租房
        $Rental_info=Rental::where('id',$common_id)->first();
        if($Rental_info){
             $likes->common_id= $common_id;
        }else{
            return $this->response->error('租房表没有对应ID', 404);
        }
      
    	\DB::beginTransaction();
        try {
            $likes->save();
        } catch (\Exception $error) {
            \DB::rollBack();
            return $this->response->errorInternal();
        }
        \DB::commit();
        return $this->response->created();
       
    }
}






















?>