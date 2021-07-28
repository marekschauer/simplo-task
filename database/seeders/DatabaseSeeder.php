<?php

namespace Database\Seeders;

use Database\Seeders\CustomerSeeder;
use Database\Seeders\CustomerGroupSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CustomerSeeder::class,
            CustomerGroupSeeder::class,
        ]);
    }
}
