<?php

namespace App\Models\Backend;

use App\Models\BackEnd\Classroom;
use App\Models\BackEnd\Section;
use App\Models\BackEnd\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'notes',
        'grade_id',
        'code',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // علاقة المرحلة الدراسية مع نفسها (المرحلة الأب)
    public function parent()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    // علاقة المرحلة الدراسية مع المراحل الفرعية
    public function children()
    {
        return $this->hasMany(Grade::class, 'grade_id');
    }

    // علاقة المرحلة الدراسية مع الفصول
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

    // علاقة المرحلة الدراسية مع المدرسين
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
