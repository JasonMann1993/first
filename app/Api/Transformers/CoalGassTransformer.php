<?php
namespace App\Api\TransFormers;

use App\Models\CoalGass;
use League\Fractal\TransformerAbstract;

class CoalGassTransformer extends TransformerAbstract
{
    public function transform(CoalGass $item)
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