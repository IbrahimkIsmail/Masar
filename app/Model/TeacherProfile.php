<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeacherProfile extends Model
{
    //   'college_certificate', 'courses_certificates', 'skills'
    protected $fillable = [
        'teacher_id',
        'full_address',
        'university_name',
        'specialty',
        'university_rate',
        'year_of_graduation',
        'dob',
        'image',
        'social_status',
        'courses',
        'skills',
        'languages'


        /***
         * -Courses
         * course_name
         * number_hours
         * name_Institution
         * year_training\
         */
        /**
         * -Skills
         * years_experience
         * name_Institution
         * mission
         * duration_employment
         * year
         * type_employment
         */

        /**
         *
         * -Languages
         * name
         * level
         */
    ];

    public function scopeteacher_id($query,$id){
        return $query->where('teacher_id',$id);

    }
}
