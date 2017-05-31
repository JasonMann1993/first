<?php

namespace App\Api\TransFormers;

use App\Models\Unlock;
use League\Fractal\TransformerAbstract;

class UnlockTransformer extends TransformerAbstract
{
    public function transform(Unlock $item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'address' => $item->address,
            'phone' => $item->phone,
            'distance' => $item->distance,
            'imgs' => $item->imgs->pluck('img')
        ];
    }
}