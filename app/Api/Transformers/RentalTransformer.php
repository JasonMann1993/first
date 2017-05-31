<?php
namespace App\Api\TransFormers;

use App\Models\Like;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use League\Fractal\TransformerAbstract;

class RentalTransformer extends TransformerAbstract
{
    public function transform(Rental $item)
    {
        $userInfo = User::where('openid', app(Request::class)->get('id'))->first();
        $isLike = $item->likes->where('user_id', $userInfo->id)->first();

        $list = [
            'id' => $item->id,
            'cell_name' => $item->cell_name,
            'size' => $item->size,
            'form' => $item->formText[$item->form],
            'price' => $item->price,
            'require' => $item->requireText[$item->require],
            'address' => $item->address,
            'phone' => $item->phone,
            'distance' => $item->distance,
            'imgs' => $item->imgs->pluck('img'),
            'is_like'=> ($isLike != null && $isLike->count() > 0) ? $isLike->status : 2,
        ];
        return $list;
    }
}