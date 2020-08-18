<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Resources\Dashboard\Notifications;
use App\Http\Resources\Dashboard\Students;
use App\Model\Father;
use App\Model\Notification;
use App\Model\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FatherController extends Controller
{
     public function index()
     {

     }

     public function getAllStudentByFatherId($id)
     {
         return new Students(Student::father_id($id)->get());
     }

     Public function fatherNotification($id){
         return new Notifications(Notification::father_id($id)->orderBy('created_at', 'desc')->get());
     }
}
