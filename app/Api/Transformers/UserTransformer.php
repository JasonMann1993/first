<?php

namespace App\Api\TransFormers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $item)
    {
        return [
            'id' => $item->id,
            'sex' => $item->sex,
            'avatar' => $item->avatar,
            'name' => $item->name,
        ];
    }
}