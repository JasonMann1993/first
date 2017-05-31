<?php
namespace App\Api\TransFormers;

use App\Models\DeliverWater;
use League\Fractal\TransformerAbstract;

class DeliverWaterTransformer extends TransformerAbstract
{
    public function transform(DeliverWater $item)
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