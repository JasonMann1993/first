<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    public $fillable = [
        'img', 'common_id', 'common_type', 'created_at', 'updated_at'
    ];

    public function commons()
    {
        return $this->morphTo();
    }

    public function getImgAttribute($img)
    {
        if (!filter_var($img, FILTER_VALIDATE_URL))
            return env('OSS_ENDPOINT') . env('OSS_PREFIX') . $img;
        return $img;
    }
}
