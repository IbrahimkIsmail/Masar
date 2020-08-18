<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class KindergartenSettings extends Model
{
    protected $fillable = ['kindergarten_id','teacher_salary', 'total_attendance_days','education_fees', 'transportation_charges', 'entertainment_fees'];

    public function kindergarten()
    {
        return $this->belongsTo('App\Model\Kindergarten');
    }
}
