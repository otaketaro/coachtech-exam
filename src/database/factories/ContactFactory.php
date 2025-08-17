<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;

/**
 * @extends Factory<Contact>
 */
class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        // Faker のロケールは config/app.php の 'faker_locale' に従います（ja_JP 推奨）
        // first_name=「苗字」, last_name=「名前」に合わせています
        return [
            'category_id' => $this->faker->numberBetween(1, 5),
            'first_name'  => $this->faker->lastName,   // 苗字（姓）
            'last_name'   => $this->faker->firstName,  // 名前（名）
            'gender'      => $this->faker->randomElement([0, 1, 2]), // 0=その他,1=男性,2=女性
            'email'       => $this->faker->unique()->safeEmail,
            'tel'         => (string) $this->faker->numberBetween(1, 99999), // 半角数字・ハイフン無し・最大5桁想定
            'address'     => $this->faker->prefecture . $this->faker->city . $this->faker->streetAddress,
            'building'    => $this->faker->boolean(60) ? $this->faker->secondaryAddress : null,
            'detail'      => mb_substr($this->faker->realText(120), 0, 120),
            'created_at'  => $this->faker->dateTimeBetween('-1 years', 'now'),
            'updated_at'  => now(),
        ];
    }
}
