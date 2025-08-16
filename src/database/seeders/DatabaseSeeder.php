<?php

namespace Database\Seeders;

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
        // CategorySeeder と ContactSeeder を呼び出す
        $this->call([
            CategorySeeder::class,
            ContactSeeder::class,
        ]);
    }
}
