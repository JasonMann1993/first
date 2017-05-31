<?php

use Illuminate\Database\Seeder;
use App\Models\CoalGass;
use App\Models\DeliverWater;
use App\Models\HouseMoving;
use App\Models\PublicToilet;
use App\Models\Recovery;
use App\Models\Rental;
use App\Models\Unlock;
class ReasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $time=\Carbon\Carbon::now();
        $reasons = [
           ['id'=>1,'common_type'=>CoalGass::class,'reasons'=>'假的','created_at'=>$time],
           ['id'=>2,'common_type'=>DeliverWater::class,'reasons'=>'假的','created_at'=>$time],
           ['id'=>3,'common_type'=>HouseMoving::class,'reasons'=>'假的','created_at'=>$time],
           ['id'=>4,'common_type'=>PublicToilet::class,'reasons'=>'假的','created_at'=>$time],
           ['id'=>5,'common_type'=>Recovery::class,'reasons'=>'假的','created_at'=>$time],
           ['id'=>6,'common_type'=>Rental::class,'reasons'=>'假的','created_at'=>$time],
           ['id'=>7,'common_type'=>Unlock::class,'reasons'=>'假的','created_at'=>$time]
        ];
        DB::table('reasons')->truncate();
        DB::table('reasons')->insert($reasons);
        //
    }
}
