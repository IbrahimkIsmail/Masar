<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Resources\Dashboard\DaliyNotifications;
use App\Http\Resources\Dashboard\Student;
use App\Http\Resources\Mobile\Feess;
use App\Http\Resources\Mobile\Notifications;
use App\Http\Resources\Mobile\SubjectRatings;
use App\Http\Resources\Mobile\Tasks;
use App\Model\dailyNotification;
use App\Model\Homework;
use App\Model\Notification;
use App\Model\PaymentHistory;
use App\Model\RegisterOfFinancialInstallment;
use App\Model\SubjectRating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function profile($id){
        return new \App\Http\Resources\Mobile\Student(\App\Model\Student::id($id)->get());
    }

    public function StudentNotifications($id){
        return new Notifications(Notification::student_id($id)->orderBy('created_at', 'desc')->get());
    }

    public function Notificationsbyid($id){
        return new Notifications(Notification::student_id($id)->orderBy('created_at', 'desc')->get());
    }

    public function StudentTasksbySubject($class_room,$subject_id){
        return new Tasks(Homework::where('class_room_id',$class_room)->where('subject_id',$subject_id)->orderBy('created_at', 'desc')->get());
    }

    public function StudentSubjectRatingBySubjectId($student_id,$subject_id){
         return new SubjectRatings(SubjectRating::SubjectRatingBySubjectId($student_id,$subject_id)->orderBy('created_at', 'desc')->get());
    }
    public function StudentRatingId($student_id,$subject_id){
        return new SubjectRatings(SubjectRating::SubjectRatingBySubjectId($student_id,$subject_id)->orderBy('created_at', 'desc')->get());
    }
    public function StudentFessList($student_id){
         return new Feess(RegisterOfFinancialInstallment::student_id($student_id)->orderBy('created_at', 'desc')->get());
    }

    public function NoteAllss($id){
        return SubjectRating::where('student_id',$id)->orderBy('created_at', 'desc')->get();
    }
}
