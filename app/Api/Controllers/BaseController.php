<?php

namespace App\Api\Controllers;

use App\Http\Controllers\Common\UploadController;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use Helpers, UploadController;


    /**
     * 处理文件上传
     * @param Request $request
     * @return array
     */
    public function handleFiles(Request $request)
    {
        $files = $request->file('img');
        $files = is_array($files) ? $files : [$files];
        $uploads = [];
        foreach ($files as $file) {
            $fileName = date('YmdHi') . str_random(6) . '.jpg';
            $uploadRes = $this->uploadFile($fileName, $file);
            if($uploadRes === true)
                array_push($uploads, $fileName);
            else
                abort(500);
        }
        return $uploads;
    }

}