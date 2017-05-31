<?php

namespace App\Http\Controllers\Home;

use App\Api\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Home\UploadRequest;
use App\Models\Img;
use Illuminate\Http\Request;

/**
 * 处理上传文件
 * Class UploadController
 * @package App\H\Controllers
 */
class UploadController extends Controller
{

//    public function handle(UploadRequest $request) // TODO 这里是个坑
    public function handle(Request $request)
    {
        $uploadRes = app(BaseController::class)->handleFiles($request);
        $uploadIds = [];
        \DB::beginTransaction();
        foreach ($uploadRes as $upload) {
            $ins = new Img();
            $ins->img = $upload;
            $ins->common_id = 0;
            $ins->common_type = '';
            try {
                $ins->save();
            } catch (\Exception $error) {
                \DB::rollBack();
                return $this->response->errorInternal();
            }
            array_push($uploadIds, $ins->id);
        }
        \DB::commit();
        return count($uploadIds) > 1 ? $uploadIds : array_first($uploadIds);
    }
}