<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Category -> Contact -> User の順でOK
        $this->call([
            CategorySeeder::class,
            ContactSeeder::class,
            UserSeeder::class, // 任意だが便利
        ]);
    }
}
