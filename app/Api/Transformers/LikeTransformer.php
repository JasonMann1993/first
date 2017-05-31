<?php

namespace App\Api\TransFormers;

use App\Models\Like;
use League\Fractal\TransformerAbstract;

class LikeTransformer extends TransformerAbstract
{
    public function transform(Like $item)
    {
        return [
            'status' => $item->status,
          
        ];
    }
}