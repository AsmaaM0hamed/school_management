<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Teacher extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'specialization_id',
        'grade_id',
        'joining_date',
        'address',
        'gender',
        'status'
    ];

    protected $casts = [
        'joining_date' => 'date',
    ];

    protected $dates = ['deleted_at'];

    const STATUS_ACTIVE = 'active';
    const STATUS_SUSPENDED = 'suspended';

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
