<?php

namespace App\Api\TransFormers;

use App\Models\PublicToilet;
use League\Fractal\TransformerAbstract;

class PublicToiletTransformer extends TransformerAbstract
{
    public function transform(PublicToilet $item)
    {
        $list = [
            'id' => $item->id,
            'name' => $item->name,
            'address' => $item->address,
            'distance' => $item->distance,
            'imgs' => $item->imgs->pluck('img')
        ];
        return $list;
    }
}