<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ContactSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ja_JP');

        $contacts = [];

        for ($i = 0; $i < 35; $i++) {
            // category_id は既に入れた categories の id (1〜5) を参照
            $categoryId = $faker->numberBetween(1, 5);

            // 性別は 1:男性, 2:女性, 3:その他
            $gender = $faker->numberBetween(1, 3);

            // 電話番号仕様に合わせて「半角数字・ハイフン無し・最大5桁」で生成
            $tel = (string) $faker->numberBetween(1, 99999);

            // 建物名はランダムで null にする場合あり
            $building = $faker->boolean(60) ? $faker->secondaryAddress : null;

            // お問い合わせ内容は仕様の「120文字以内」を守る
            $detail = mb_substr($faker->realText(120), 0, 120);

            // created_at / updated_at はランダムな過去日時
            $dt = Carbon::instance($faker->dateTimeBetween('-1 years', 'now'));

            $contacts[] = [
                'category_id' => $categoryId,
                'first_name'  => $faker->lastName,    // 姓
                'last_name'   => $faker->firstName,   // 名
                'gender'      => $gender,
                'email'       => $faker->unique()->safeEmail,
                'tel'         => $tel,
                'address'     => $faker->prefecture . $faker->city . $faker->streetAddress,
                'building'    => $building,
                'detail'      => $detail,
                'created_at'  => $dt,
                'updated_at'  => $dt,
            ];
        }

        DB::table('contacts')->insert($contacts);
    }
}

