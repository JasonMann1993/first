<?php
namespace App\Api\TransFormers;

use App\Models\Recovery;
use League\Fractal\TransformerAbstract;

class RecoveryTransformer extends TransformerAbstract
{
    public function transform(Recovery $item)
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