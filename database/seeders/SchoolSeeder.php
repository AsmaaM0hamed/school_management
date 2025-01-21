<?php

namespace Database\Seeders;

use App\Models\BackEnd\Grade;
use App\Models\BackEnd\Classroom;
use App\Models\BackEnd\Section;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    public function run()
    {
        $grades = [
            [
                'name' => 'المرحلة الابتدائية',
                'code' => 'PRI',
                'description' => 'المرحلة الابتدائية من الصف الأول إلى السادس',
                'is_active' => true,
            ],
            [
                'name' => 'المرحلة المتوسطة',
                'code' => 'MID',
                'description' => 'المرحلة المتوسطة من الصف الأول إلى الثالث',
                'is_active' => true,
            ],
            [
                'name' => 'المرحلة الثانوية',
                'code' => 'SEC',
                'description' => 'المرحلة الثانوية من الصف الأول إلى الثالث',
                'is_active' => true,
            ],
        ];

        foreach ($grades as $grade) {
            $gradeModel = Grade::create($grade);

            if ($grade['code'] === 'PRI') {
                $classrooms = [
                    ['name' => 'الصف الأول الابتدائي', 'code' => 'PRI1'],
                    ['name' => 'الصف الثاني الابتدائي', 'code' => 'PRI2'],
                    ['name' => 'الصف الثالث الابتدائي', 'code' => 'PRI3'],
                    ['name' => 'الصف الرابع الابتدائي', 'code' => 'PRI4'],
                    ['name' => 'الصف الخامس الابتدائي', 'code' => 'PRI5'],
                    ['name' => 'الصف السادس الابتدائي', 'code' => 'PRI6'],
                ];
            } elseif ($grade['code'] === 'MID') {
                $classrooms = [
                    ['name' => 'الصف الأول المتوسط', 'code' => 'MID1'],
                    ['name' => 'الصف الثاني المتوسط', 'code' => 'MID2'],
                    ['name' => 'الصف الثالث المتوسط', 'code' => 'MID3'],
                ];
            } else {
                $classrooms = [
                    ['name' => 'الصف الأول الثانوي', 'code' => 'SEC1'],
                    ['name' => 'الصف الثاني الثانوي', 'code' => 'SEC2'],
                    ['name' => 'الصف الثالث الثانوي', 'code' => 'SEC3'],
                ];
            }

            foreach ($classrooms as $classroom) {
                $classroomModel = $gradeModel->classrooms()->create($classroom);

                $sections = [
                    ['name' => 'فصل ' . $classroom['code'] . '-A', 'status' => true],
                    ['name' => 'فصل ' . $classroom['code'] . '-B', 'status' => true],
                    ['name' => 'فصل ' . $classroom['code'] . '-C', 'status' => true],
                ];

                foreach ($sections as $section) {
                    $classroomModel->sections()->create([
                        'name' => $section['name'],
                        'status' => $section['status'],
                        'grade_id' => $gradeModel->id
                    ]);
                }
            }
        }
    }
}
