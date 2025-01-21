<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Backend\ParentModel;
use Illuminate\Support\Facades\Hash;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parents = [
            [
                'email' => 'parent1@example.com',
                'password' => Hash::make('password123'),
                'father_name' => 'أحمد محمد',
                'father_national_id' => '1234567890',
                'father_passport_id' => 'A123456',
                'father_phone' => '0123456789',
                'father_job' => 'مهندس',
                'father_nationality' => 'مصري',
                'father_blood_type' => 'A+',
                'father_religion' => 'مسلم',
                'father_address' => 'القاهرة، مصر',
                'mother_name' => 'سارة أحمد',
                'mother_national_id' => '0987654321',
                'mother_passport_id' => 'B123456',
                'mother_phone' => '0123456788',
                'mother_job' => 'طبيبة',
                'mother_nationality' => 'مصرية',
                'mother_blood_type' => 'O+',
                'mother_religion' => 'مسلم',
                'mother_address' => 'القاهرة، مصر',
                'status' => 1,
            ],
            [
                'email' => 'parent2@example.com',
                'password' => Hash::make('password123'),
                'father_name' => 'محمود علي',
                'father_national_id' => '2234567890',
                'father_passport_id' => 'C123456',
                'father_phone' => '0123456787',
                'father_job' => 'محاسب',
                'father_nationality' => 'مصري',
                'father_blood_type' => 'B+',
                'father_religion' => 'مسلم',
                'father_address' => 'الإسكندرية، مصر',
                'mother_name' => 'نور محمد',
                'mother_national_id' => '1987654321',
                'mother_passport_id' => 'D123456',
                'mother_phone' => '0123456786',
                'mother_job' => 'مدرسة',
                'mother_nationality' => 'مصرية',
                'mother_blood_type' => 'AB+',
                'mother_religion' => 'مسلم',
                'mother_address' => 'الإسكندرية، مصر',
                'status' => 1,
            ],
            [
                'email' => 'parent3@example.com',
                'password' => Hash::make('password123'),
                'father_name' => 'كريم حسن',
                'father_national_id' => '3234567890',
                'father_passport_id' => 'E123456',
                'father_phone' => '0123456785',
                'father_job' => 'تاجر',
                'father_nationality' => 'مصري',
                'father_blood_type' => 'O-',
                'father_religion' => 'مسلم',
                'father_address' => 'المنصورة، مصر',
                'mother_name' => 'هدى علي',
                'mother_national_id' => '2987654321',
                'mother_passport_id' => 'F123456',
                'mother_phone' => '0123456784',
                'mother_job' => 'محامية',
                'mother_nationality' => 'مصرية',
                'mother_blood_type' => 'A-',
                'mother_religion' => 'مسلم',
                'mother_address' => 'المنصورة، مصر',
                'status' => 1,
            ],
        ];

        foreach ($parents as $parent) {
            ParentModel::create($parent);
        }
    }
}
