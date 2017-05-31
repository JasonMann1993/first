<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $fillable = [
        'user_id', 'common_id', 'common_type', 'created_at'
    ];
    public $statusText =[
        1 => '喜欢',
        2 => '不喜欢'
    ];

    public function Like()
    {
        return $this->morphTo();
    }

    /**
     * 获取用户 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
