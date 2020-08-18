<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SubjectRating extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'teacher_id',
        'kindergarten_id',
        'rating'
    ];


    public function scopeSubjectRatingBySubjectId($query,$student_id,$subject_id){
        return $query->where('student_id', $student_id)->where('subject_id', $subject_id);

    }

    public function scopestudent_id($query,$id){
        return $query->where('student_id', $id);

    }
    public function students(){
        return $this->belongsTo(Student::class);
    }

    public function subjects(){
        return $this->belongsTo(Subject::class);
    }
}
