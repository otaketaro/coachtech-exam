<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // 要件通りの5件（「商品“の”お届けについて」←おを含む）
        $items = [
            '商品のお届けについて',
            '商品の交換について',
            '商品トラブル',
            'ショップへのお問い合わせ',
            'その他',
        ];

        foreach ($items as $content) {
            Category::updateOrCreate(
                ['content' => $content],
                ['content' => $content]
            );
        }
    }
}
