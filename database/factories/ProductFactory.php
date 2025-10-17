<?php

namespace Database\Factories;

use App\Models\{Category, Company, ReasonTax, User};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;
        return [
            'name'           => $faker->word(),
            'code'           => $faker->unique()->ean8(),
            'price'          => $faker->randomFloat(2, 100, 10000),
            'retention'      => $faker->randomFloat(2, 0, 50),
            'type'           => $faker->randomElement(['service', 'unit']),
            'tax'            => $faker->numberBetween(0, 30),
            'reason_tax_id'      => ReasonTax::inRandomOrder()->value('id'),
            'company_id'     => Company::inRandomOrder()->value('id'),
            'user_id'        => User::inRandomOrder()->value('id'),
            'category_id'    => Category::inRandomOrder()->value('id'),
            'quantity'=>$faker->numberBetween(0, 30)
        ];
    }
}
