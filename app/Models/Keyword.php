<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Api\TransFormers\CoalGassTransformer;
use App\Api\TransFormers\DeliverWaterTransformer;
use App\Api\TransFormers\HouseMovingTransformer;
use App\Api\TransFormers\PublicToiletTransformer;
use App\Api\TransFormers\RecoveryTransformer;
use App\Api\TransFormers\RentalTransformer;
use App\Api\TransFormers\UnlockTransformer;

class Keyword extends Model
{
    public $fillable = [
        'content' , 'common_id' , 'common_type' ,'created_at' ,'updated_at'
    ];

    public function commons()
    {
        return $this->morphTo('common');
    }

    public $modelWithTransformers = [
        CoalGass::class => CoalGassTransformer::class,
        DeliverWater::class => DeliverWaterTransformer::class,
        HouseMoving::class => HouseMovingTransformer::class,
        PublicToilet::class => PublicToiletTransformer::class,
        Recovery::class => RecoveryTransformer::class,
        Rental::class => rentaltransformer::class,
        Unlock::class => unlocktransformer::class
    ];

    public $modelWithNum = [
        CoalGass::class => 1,
        DeliverWater::class => 2,
        HouseMoving::class => 3,
        PublicToilet::class => 4,
        Recovery::class => 5,
        Rental::class => 6,
        Unlock::class => 7
    ];

}
