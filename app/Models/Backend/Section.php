<?php

namespace App\Models\BackEnd;

use App\Models\BackEnd\Classroom;
use App\Models\BackEnd\Grade;
use App\Models\BackEnd\Teacher; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'status', 'grade_id', 'classroom_id'];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'section_teacher');
    }
}
