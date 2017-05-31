<?php

namespace App\Http\Controllers\Manage;
use App\Http\Requests\Manage\ReasonRequest;
use Illuminate\Http\Request;
use App\Models\Reason;
use Carbon\Carbon;
class ReasonsController extends BaseController
{
    /**
     * 原因列表页
     */
    public function index(Request $request){
        $where = [];
        if($tmpInput = $request->get('common_type'))
            array_push($where,['common_type',$tmpInput]);
    	$lists = Reason::where($where)->orderBy('id')->paginate(10);
    	return view('manage.reasons.index',compact('lists'));
    }
    /**
     * 修改页面
     */
    public function edit($id){
    	$info = Reason::find($id);
    	$info->common_name = $info->commonName[$info->common_type];
    	return view('manage.reasons.edit',compact('info'));
    }
    /**
     * 更新
     */
     public function update(Request $request, $id)
    {
        $info = Reason::findOrFail($id);
        $res = $request->get('reasons');
        $info->reasons = $res;
        if($info->save()){
        	return $this->success('修改成功', redirect('/manage/reasons'));
        }else{
        	return $this->success('修改失败', redirect('/manage/reasons'));
        }
    }

    public function create()
    {
        return view('manage.reasons.create');
    }

    public function store(ReasonRequest $request)
    {
        $reasons = $request->except('_token');
        $reasons['created_at'] = Carbon::now();
        $res = Reason::insert($reasons);
        if($res){
            return $this->success('添加成功',redirect('/manage/reasons'));
        }
    }

    public function destroy($id)
    {
        $info = Reason::findOrFail($id);
        $info->delete();
        session()->flash('success', '删除成功');
        return redirect()->back();
    }
}
