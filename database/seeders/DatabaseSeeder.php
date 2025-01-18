<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SchoolSeeder;
use Database\Seeders\SpecializationSeeder;
use Database\Seeders\ReferenceTablesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SchoolSeeder::class,
            SpecializationSeeder::class,
            ReferenceTablesSeeder::class,
        ]);
    }
}
