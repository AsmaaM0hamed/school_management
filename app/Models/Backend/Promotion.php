<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'from_class_id',
        'to_class_id',
        'from_section_id',
        'to_section_id',
        'from_grade_id',
        'to_grade_id',
        'promotion_date',
        'notes',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fromClass()
    {
        return $this->belongsTo(Classroom::class, 'from_class_id');
    }

    public function toClass()
    {
        return $this->belongsTo(Classroom::class, 'to_class_id');
    }

    public function fromSection()
    {
        return $this->belongsTo(Section::class, 'from_section_id');
    }

    public function toSection()
    {
        return $this->belongsTo(Section::class, 'to_section_id');
    }

    public function fromGrade()
    {
        return $this->belongsTo(Grade::class, 'from_grade_id');
    }

    public function toGrade()
    {
        return $this->belongsTo(Grade::class, 'to_grade_id');
    }
}
