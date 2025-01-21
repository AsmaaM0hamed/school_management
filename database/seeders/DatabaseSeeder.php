<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SchoolSeeder;
use Database\Seeders\SpecializationSeeder;
use Database\Seeders\ReferenceTablesSeeder;
use Database\Seeders\ParentSeeder;
use Database\Seeders\StudentSeeder;

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
            ParentSeeder::class,     // Add parents first
            StudentSeeder::class,    // Then students (since they depend on parents)
        ]);
    }
}
