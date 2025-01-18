<?php

namespace App\Models\BackEnd;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ParentModel extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'parents';

    protected $fillable = [
        'email',
        'password',
        // معلومات الأب
        'father_name',
        'father_national_id',
        'father_passport_id',
        'father_phone',
        'father_job',
        'father_nationality_id',
        'father_blood_type_id',
        'father_religion_id',
        'father_address',
        // معلومات الأم
        'mother_name',
        'mother_national_id',
        'mother_passport_id',
        'mother_phone',
        'mother_job',
        'mother_nationality_id',
        'mother_blood_type_id',
        'mother_religion_id',
        'mother_address',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'status' => 'boolean',
        'father_nationality_id' => 'integer',
        'father_blood_type_id' => 'integer',
        'father_religion_id' => 'integer',
        'mother_nationality_id' => 'integer',
        'mother_blood_type_id' => 'integer',
        'mother_religion_id' => 'integer',
    ];

 
    public function students()
    {
        return $this->hasMany(Student::class, 'parent_id');
    }

 
    public function fatherNationality()
    {
        return $this->belongsTo(Nationality::class, 'father_nationality_id');
    }

    public function motherNationality()
    {
        return $this->belongsTo(Nationality::class, 'mother_nationality_id');
    }


    public function fatherBloodType()
    {
        return $this->belongsTo(BloodType::class, 'father_blood_type_id');
    }

    public function motherBloodType()
    {
        return $this->belongsTo(BloodType::class, 'mother_blood_type_id');
    }

 
    public function fatherReligion()
    {
        return $this->belongsTo(Religion::class, 'father_religion_id');
    }

    public function motherReligion()
    {
        return $this->belongsTo(Religion::class, 'mother_religion_id');
    }
}
