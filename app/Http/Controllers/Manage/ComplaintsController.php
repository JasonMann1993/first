<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Carbon\Carbon;
use App\Models\AuditLog;
class ComplaintsController extends BaseController
{
    //投诉列表页
    public function index(Request $request){
    	$where = [];
    	//搜索条件
        if ($tmpInput = $request->get('status'))
            array_push($where, ['status',$tmpInput]);
    	$lists = Complaint::where($where)->orderBy('id','desc')->paginate(10);

    	return view('manage.complaints.index',compact('lists'));
    }
    //删除数据
    public function destroy($id)
   {
        $info = Complaint::findOrFail($id);
        $info->delete();
        session()->flash('success', '删除成功');
        return redirect()->back();

   }
   //详情页
    public function show($id)
    {
        $info = Complaint::findOrFail($id);
        $info->reasons = explode('#',$info->reasons);
        $res = $info->common_type::findOrfail($info->common_id);
        $common = class_basename($info->common_type);
        $common = studly_case($common);
        return view('manage.complaints.show', compact('info','res','common'));
    }

    /**
     * 审核
     * @param HouseMoveRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function audit(Request $request, $id)
    {
        $info = Complaint::findOrFail($id);
        # 修改 status
        $info->status = '2';
        $info->audited_at = Carbon::now();
        $res = $info->common_type::findOrFail($info->common_id);
        if($request->get('type')=='1'){
            $res->type = false;
            $res->status = 4;
        }else{
            $res->type = true;
            $res->status = 1;
        }
        try {
            $res->save();
            $info->save();
            # 添加记录
            AuditLog::insert([
                'remark' => $request->get('remark'),
                'value' => $request->get('type'),
                'common_id' => $info->id,
                'common_type' => Complaint::class,
                'created_at' => Carbon::now()
            ]);
        } catch (\Exception $error) {
            return $this->rollback(null, back()->withInput());
        }

        \DB::commit();
        return $this->success('审核成功', redirect($request->get('url')));
    }

}
