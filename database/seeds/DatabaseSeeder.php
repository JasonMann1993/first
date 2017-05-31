<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MenuSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UnlockSeeder::class);
        $this->call(DeliverWaterSeeder::class);
        $this->call(HouseMoveSeeder::class);
        $this->call(ComplaintSeeder::class);
        $this->call(CoalGassSeeder::class);
        $this->call(RecoverySeeder::class);
        $this->call(PublicToiletSeeder::class);
        $this->call(RentalSeeder::class);
        $this->call(ReasonsSeeder::class);
    }
}
