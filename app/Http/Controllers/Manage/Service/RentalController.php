<?php

namespace App\Http\Controllers\Manage\Service;

use App\Http\Controllers\Manage\BaseController;
use App\Http\Requests\Manage\Service\RentalRequest;
use App\Models\AuditLog;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;


/**
 * 租房管理
 * Class RentalController
 * @package App\Http\Controllers\Manage\Service
 */
class RentalController extends BaseController
{
    public function index(Request $request)
    {
        $where = [];
        if ($tmpInput = $request->get('name'))
            array_push($where, ['name', 'like', '%' . $tmpInput . '%']);
        if (($tmpInput = $request->get('status')) || ($tmpInput != ''))
            array_push($where, ['status', $tmpInput]);

        $lists = Rental::latest('id')->where($where)->paginate(10);

        return view('manage.service.rental.index', compact('lists'));
    }

    /**
     * 显示隐藏数据
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hide($id)
    {
        $info = Rental::findOrFail($id);
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
        $info = Rental::findOrFail($id);

        return view('manage.service.rental.edit', compact('info'));
    }

    /**
     * 审核
     * @param RentalRequest $request
     * @param $id
     * @return bool|null
     */
    public function audit(RentalRequest $request, $id)
    {
        $info = Rental::findOrFail($id);
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
                'common_type' => Rental::class,
                'created_at' => Carbon::now()
            ]);
        } catch (\Exception $error) {
            return $this->rollback(null, back()->withInput());
        }

        \DB::commit();
        return $this->success('审核成功', redirect($request->get('url')));
    }

    /**
     * @param RentalRequest $request
     * @param $id
     * @return bool|null
     */
    public function update(RentalRequest $request, $id)
    {
        $info = Rental::findOrFail($id);
        $info->name = $request->get('name');
        $info->phone = $request->get('phone');
        $info->remark = $request->get('remark');
        $info->address = $request->get('address');
        $info->longitude = $request->get('longitude');
        $info->latitude = $request->get('latitude');
        $info->form = $request->get('form');
        $info->require = $request->get('require');
        $info->size = $request->get('size');
        $info->price = $request->get('price');

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
        $info = Rental::findOrFail($id);

        return view('manage.service.rental.show', compact('info'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $info = Rental::findOrFail($id);
        $info->delete();
        session()->flash('success', '删除成功');
        return redirect()->back();
    }
}
