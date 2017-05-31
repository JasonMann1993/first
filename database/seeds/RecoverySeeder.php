<?php

use Illuminate\Database\Seeder;

class RecoverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
              
        factory(App\Models\Recovery::class,101)->create()->each(function ($item) {
            factory(App\Models\Img::class, 1)->create([
                'common_id' => $item->id,
                'common_type' => \App\Models\Recovery::class
            ]);
        });
    }
}
