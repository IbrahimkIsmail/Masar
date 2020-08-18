<?php

namespace App\Model;

use App\Model\Student;
use Illuminate\Database\Eloquent\Model;

class dailyNotification extends Model
{
    protected $fillable = [
        'title',
        'type',
        'student_id'
    ];

    public function scopestudent_id($query,$student_id){
        return $query->where('student_id', $student_id);
    }

    function student()
    {
        return $this->belongsTo(Student::class);
    }
}
