<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    //
    use SoftDeletes;
    public $statusText = [
        1 => '待处理',
        2 => '已处理',
    ];
    public $commonName = [
        'App\Models\CoalGass' => '煤气',
        'App\Models\DeliverWater' => '送水',
        'App\Models\HouseMoving' => '搬家',
        'App\Models\PublicToilet' => '公厕',
        'App\Models\Recovery' => '回收',
        'App\Models\Rental' => '租房',
        'App\Models\Unlock' => '开锁',
    ];
    /**
     * 获取用户 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
