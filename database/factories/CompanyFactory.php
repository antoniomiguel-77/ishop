<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin\Company>
 */
class CompanyFactory extends Factory
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
            'name'          => $faker->company(),
            'email'         => $faker->unique()->companyEmail(),
            'logo'          => $faker->imageUrl(200, 200, 'business', true, 'Logo'),
            'phone'         => $faker->phoneNumber(),
            'otherphone'    => $faker->optional()->phoneNumber(),
            'address'       => $faker->address(),
            'country'       => 'Angola',
            'taxpayer'      => $faker->unique()->numerify('500012582'),
            'website'       => $faker->optional()->url(),
            'currency'      => 'AOA',
            'invoiceSerie'  => strtoupper(Str::random(3)),
            'regime'        => $faker->randomElement(['Geral', 'Simplificado', 'Exclusão']),
            'tax'           => $faker->randomFloat(2, 0, 14),
        ];
    }
}
