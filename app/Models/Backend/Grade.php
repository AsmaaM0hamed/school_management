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

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }


    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
