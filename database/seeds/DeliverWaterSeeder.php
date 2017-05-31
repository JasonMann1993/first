<?php

use Illuminate\Database\Seeder;

class DeliverWaterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      
        factory(App\Models\DeliverWater::class,101)->create()->each(function ($item) {
            factory(App\Models\Img::class, 1)->create([
                'common_id' => $item->id,
                'common_type' => \App\Models\DeliverWater::class
            ]);
        });
    }
}
