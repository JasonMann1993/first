<?php

namespace App\Api\TransFormers;

use App\Models\Keyword;
use League\Fractal\TransformerAbstract;

class SearchTransformer extends TransformerAbstract
{
    public function transform(Keyword $item)
    {
        return ['_type' => $item->modelWithNum[$item->common_type]] + app($item->modelWithTransformers[$item->common_type])->transform($item->common);
    }
}