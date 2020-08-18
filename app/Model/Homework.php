<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    protected $fillable = [
        'page_number',
        'assignment_description',
        'status',
        'class_room_id',
        'teacher_id',
        'kindergarten_id',
        'manager_id',
        'subject_id',
//        'father_id',// useless !!
    ];//end of fillable

    public function scopeclass_room_id($query,$class_room){
        return $query->where('class_room_id', $class_room);

    }
    public function scopesubject_id($query,$class_room,$subject_id){
        return $query->where('class_room_id', $class_room)->where('subject_id',$subject_id);

    }

    //many to many
    public function student(){
        return $this->belongsToMany(Student::class);
    }//end of Class student Relation


    //inverse of one to many relation

    public function classRoom(){
        return $this->belongsTo('App\Model\ClassRoom');
    }//end of Class Room Relation
    public function teacher(){
        return $this->belongsTo('App\Model\Teacher');
    }//end of Class teacher Relation
    public function kindergarten(){
        return $this->belongsTo('App\Model\Kindergarten');
    }//end of Class kindergarten Relation
    public function subject(){
        return $this->belongsTo(Subject::class);
    }//end of Class subject Relation


    //end inverse of one to many relation
}
