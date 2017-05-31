<?php

namespace App\Http\Controllers\Common;

use OSS\Core\OssException;
use OSS\OssClient;


trait UploadController
{

    /**
     * 上传一个文件
     *
     * @param $fileName
     * @param $file
     * @return bool|string
     */
    public function uploadFile($fileName, $file)
    {
        $ins = $this->getUploadIns();
        $bucket = env('OSS_BUCKET');
        try {
            $ins->uploadFile($bucket, env('OSS_PREFIX') . $fileName, $file);
        } catch (OssException $e) {
            return $e->getMessage();
        }
        return true;
    }

    /**
     * 获取上传文件的实例
     *
     * @return OssClient|string
     */
    protected function getUploadIns()
    {
        static $ins;
        if ($ins)
            return $ins;
        $accessKeyId = env('OSS_ACCESS_KEY_ID');
        $accessKeySecret = env('OSS_ACCESS_KEY_SECRET');
        $endpoint = env('OSS_ENDPOINT');
        try {
            $ins = new OssClient($accessKeyId, $accessKeySecret, $endpoint, true);
        } catch (OssException $e) {
            return $e->getMessage();
        }
        return $ins;
    }
}
