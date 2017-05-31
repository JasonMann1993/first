<?php
namespace App\Api\TransFormers;

use App\Models\HouseMoving;
use League\Fractal\TransformerAbstract;

class HouseMovingTransformer extends TransformerAbstract
{
    public function transform(HouseMoving $item)
    {
        $list = [
            'id' => $item->id,
            'name' => $item->name,
            'address' => $item->address,
            'phone' => $item->phone,
            'distance' => $item->distance,
            'imgs' => $item->imgs->pluck('img')
        ];
        return $list;
    }
}