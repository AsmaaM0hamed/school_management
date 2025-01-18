<?php

namespace Database\Seeders;

use App\Models\Backend\Specialization;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specializations = [
            ['name' => 'لغة عربية'],
            ['name' => 'علوم'],
            ['name' => 'رياضيات'],
            ['name' => 'لغة إنجليزية'],
            ['name' => 'حاسب آلي'],
            ['name' => 'دراسات إسلامية'],
            ['name' => 'دراسات اجتماعية'],
            ['name' => 'تربية رياضية'],
            ['name' => 'تربية فنية'],
            ['name' => 'كيمياء'],
            ['name' => 'فيزياء'],
            ['name' => 'أحياء'],
        ];

        foreach ($specializations as $specialization) {
            Specialization::create($specialization);
        }
    }
}
