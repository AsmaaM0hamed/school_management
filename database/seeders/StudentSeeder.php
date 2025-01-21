<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Backend\Student;
use App\Models\Backend\Grade;
use App\Models\Backend\Classroom;
use App\Models\Backend\Section;
use App\Models\Backend\ParentModel;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get IDs for relationships
        $grade = Grade::first();
        $classroom = Classroom::first();
        $section = Section::first();
        $parents = ParentModel::all();

        if (!$grade || !$classroom || !$section || $parents->isEmpty()) {
            throw new \Exception('Please make sure grades, classrooms, sections, and parents are seeded first.');
        }

        $students = [
            [
                'name' => 'عمر أحمد',
                'email' => 'omar@example.com',
                'password' => Hash::make('password123'),
                'birth_date' => '2010-05-15',
                'gender' => 'male',
                'national_id' => '3012345678',
                'grade_id' => $grade->id,
                'classroom_id' => $classroom->id,
                'section_id' => $section->id,
                'parent_id' => $parents[0]->id,
                'academic_year' => '2023-2024',
                'status' => 'active',
            ],
            [
                'name' => 'سارة محمود',
                'email' => 'sara@example.com',
                'password' => Hash::make('password123'),
                'birth_date' => '2010-08-20',
                'gender' => 'female',
                'national_id' => '3012345679',
                'grade_id' => $grade->id,
                'classroom_id' => $classroom->id,
                'section_id' => $section->id,
                'parent_id' => $parents[1]->id,
                'academic_year' => '2023-2024',
                'status' => 'active',
            ],
            [
                'name' => 'محمد كريم',
                'email' => 'mohamed@example.com',
                'password' => Hash::make('password123'),
                'birth_date' => '2010-03-10',
                'gender' => 'male',
                'national_id' => '3012345680',
                'grade_id' => $grade->id,
                'classroom_id' => $classroom->id,
                'section_id' => $section->id,
                'parent_id' => $parents[2]->id,
                'academic_year' => '2023-2024',
                'status' => 'active',
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
