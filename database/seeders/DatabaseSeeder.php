<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TaxReasonSeed::class);
        $this->call(CompanySeed::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeed::class);
        $this->call(ProductSeeder::class);
    }
}
