<?php
namespace App\Http\Controllers\Manage\Management;
use App\Models\Unlock;
use Illuminate\Http\Request;
use App\Http\Controllers\Manage\BaseController;
use App\Http\Requests\Manage\Management\UnlockRequest;
use Carbon\Carbon;
use App\Models\AuditLog;


class UnlockController extends BaseController
{
    /**
     *       开锁管理
     *      - 状态
     *      - 搜索
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
     public function index(Request $request)
    {
        $where = [];
        if ($tmpInput = $request->get('name'))
            array_push($where, ['name', 'like', '%' . $tmpInput . '%']);
        if (($tmpInput = $request->get('status')) || ($tmpInput != '')){   
            array_push($where, ['status',$tmpInput]);
        }
        $lists = Unlock::latest('id')->where($where)->paginate(10);
        return view('manage.unlock.index', compact('lists'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $info = Unlock::findOrFail($id);
        $info->delete();
        session()->flash('success','删除成功');
        return redirect()->back();
    }


    /**
     * 显示隐藏数据
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hide($id)
    {
        $info = Unlock::findOrFail($id);
        $info->type = (bool)(!$info->type);
        $info->save();
        return redirect()->back();
    }


    /**
     * 修改
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $info = Unlock::findOrFail($id);

        return view('manage.unlock.edit', compact('info'));
    }


    /**
     * 审核
     * @param HouseMoveRequest $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function audit(UnlockRequest $request, $id)
    {
        $info = Unlock::findOrFail($id);
        # 修改 status
        $info->status = $request->get('type');
        $info->verify = Carbon::now();
        try {
            $info->save();
            # 添加记录
            AuditLog::insert([
                'remark' => $request->get('remark'),
                'value' => $request->get('type'),
                'common_id' => $info->id,
                'common_type' => Unlock::class,
                'created_at' => Carbon::now()
            ]);
        } catch (\Exception $error) {
            return $this->rollback(null, back()->withInput());
        }

        \DB::commit();
        return $this->success('审核成功', redirect($request->get('url')));
    }

    /**
     * 更新
     *
     * @param HouseMoveRequest $request
     * @param $id
     * @return bool|null
     */
    public function update(UnlockRequest $request, $id)
    {
        $info = Unlock::findOrFail($id);
        $info->name = $request->get('name');
        $info->phone = $request->get('phone');
        $info->remark = $request->get('remark');
        $info->address = $request->get('address');
        $info->longitude = $request->get('longitude');
        $info->latitude = $request->get('latitude');
        $info->save();
        return $this->success('修改成功', redirect($request->get('url')));
    }
     /**
     * 显示
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $info = Unlock::findOrFail($id);

        return view('manage.unlock.show', compact('info'));
    }
}
