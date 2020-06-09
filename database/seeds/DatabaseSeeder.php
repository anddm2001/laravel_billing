<?php

use Illuminate\Database\Seeder;
use App\Models\Stat;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for($i= 0; $i < 500 ;$i++){
            Stat::create(["status" => 1]);
        }

        for($i= 0; $i < 467 ;$i++){
            Stat::create(["status" => 2]);
        }

    }
}
