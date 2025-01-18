<?php

namespace Database\Seeders;

use App\Models\BackEnd\BloodType;
use App\Models\BackEnd\Nationality;
use App\Models\BackEnd\Religion;
use Illuminate\Database\Seeder;

class ReferenceTablesSeeder extends Seeder
{
    public function run()
    {
        // فصائل الدم
        $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        foreach ($bloodTypes as $type) {
            BloodType::create(['name' => $type]);
        }

        // الديانات
        $religions = ['الإسلام', 'المسيحية', 'اليهودية'];
        foreach ($religions as $religion) {
            Religion::create(['name' => $religion]);
        }

        // الجنسيات
        $nationalities = [
            'مصري',
            'سعودي',
            'كويتي',
            'إماراتي',
            'عماني',
            'بحريني',
            'قطري',
            'يمني',
            'عراقي',
            'سوري',
            'لبناني',
            'أردني',
            'فلسطيني',
            'سوداني',
            'ليبي',
            'تونسي',
            'جزائري',
            'مغربي',
            'موريتاني'
        ];
        
        foreach ($nationalities as $nationality) {
            Nationality::create(['name' => $nationality]);
        }
    }
}
