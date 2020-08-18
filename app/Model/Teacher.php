<?php

namespace App\Model;

//use App\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasApiTokens, Notifiable;
    protected $fillable = [
        'name',
        'ps_id',
        'manager_id',
        'kindergarten_id',
        'mobile_number',
        'email',
        'password',
        'status',
//        'type',
//        'subjects',
        //تاريخ بدء العمل
    ];//end of fillable
    /*******************************************************************************/

//many to many through relation
    public function scopeid($query,$id){
        return $query->where('id',$id);
    }

    public function profile(){
        return $this->belongsTo(TeacherProfile::class,'id');
    }
    public function students()
    {
        return $this->hasManyThrough(Student::class, ClassRoom::class);
    }//end of Student

//many to many relations

    function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function classRoom()
    {
        return $this->belongsToMany(ClassRoom::class);
    }//end of class room relation


//one to one relation


//end one to one relation
    /*******************************************************************************/

//one to many relation
    public function dailyRatingRecords()
    {
        return $this->hasMany('App\Model\DailyRatingRecord');
    }//end of DailyRatingRecord relation

    public function homeworks()
    {
        return $this->hasMany('App\Model\Homework');
    }//end of homework relation

//end one to many relation
    /*******************************************************************************/


//Inverse  one to many relation

    public function manager()
    {
        return $this->belongsTo('App\Model\Manager');
    }//end of manager relation

    public function kindergarten()
    {
        return $this->belongsTo('App\Model\Kindergarten');
    }//end of kindergarten relation

    public function staffAttendance()
    {
        return $this->hasMany('App\Model\StaffAttendance');
    }//end of StaffAttendance


    public function studentAttendances()
    {
        return $this->hasMany('App\Model\StudentAttendance');
    }//end of studentAttendance
//end of Inverse one rto many relation
    /*******************************************************************************/


    public function salaries()
    {
        return $this->hasMany('App\Model\Salary');
    }
}
