<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        // Factory を使って 35 件生成（要件準拠）
        Contact::factory()->count(35)->create();
    }
}
