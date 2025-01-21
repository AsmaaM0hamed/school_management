<?php

namespace App\Models\Backend;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Backend\Grade;
use App\Models\Backend\Classroom;
use App\Models\Backend\Section;
use App\Models\Backend\ParentModel;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'birth_date',
        'gender',
        'national_id',
        'photo',
        'grade_id',
        'classroom_id',
        'section_id',
        'academic_year',
        'parent_id',
        'status',
        'notes'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'birth_date',
    ];

    // العلاقة مع الصف الدراسي
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    // العلاقة مع الفصل
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    // العلاقة مع المجموعة
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    // العلاقة مع ولي الأمر
    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }

    // تشفير كلمة المرور
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // دالة مساعدة للحصول على الحالة الدراسية
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'active' => 'نشط',
            'inactive' => 'غير نشط',
            'graduated' => 'متخرج',
            default => 'غير معروف'
        };
    }
}
