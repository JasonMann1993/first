<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    //
     public $commonName = [
         'App\Models\CoalGass' => '煤气',
         'App\Models\DeliverWater' => '送水',
         'App\Models\HouseMoving' => '搬家',
         'App\Models\PublicToilet' => '公厕',
         'App\Models\Recovery' => '回收',
         'App\Models\Rental' => '租房',
         'App\Models\Unlock' => '开锁',
     ];
}
