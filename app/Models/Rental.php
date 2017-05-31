<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental extends Model
{
    //
    use SoftDeletes,Common;

    public $formText = [
        1 => '一室一厅',
        2 => '二室一厅',
        3 => '三室一厅',
    ];

    public $requireText = [
        1 => '整租',
        2 => '合租',
    ];

    public $statusText = [
        0 => '待审核',
        1 => '审核通过',
        2 => '已驳回',
        3 => '垃圾信息',
        4 => '已下架',
    ];
    public $typeText = [
        true => '显示',
        false => '隐藏',
    ];

    /**
     * 获取用户 *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 获取图片
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function imgs()
    {
        return $this->morphMany(Img::class, 'common');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'common');
    }

}
