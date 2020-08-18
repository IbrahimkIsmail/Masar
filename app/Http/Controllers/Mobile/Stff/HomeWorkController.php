<?php

namespace App\Http\Controllers\Mobile\Stff;

use App\Http\Resources\Mobile\Stff\HomeWorks;
use App\Model\dailyNotification;
use App\Model\Homework;
use App\Model\Notification;
use App\Model\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HomeWorkController extends Controller
{
    public function addHomeWork(Request $request){
        $validator = Validator::make($request->all(), [
            'page_number' => 'required',
            'assignment_description' => 'required',
            'status' => 'required',
            'class_room_id' => 'required',
            'teacher_id' => 'required',
            'manager_id' => 'required',
            'subject_id' => 'required',
            'kindergarten_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $homeWork = Homework::create([
            'page_number' => $request->page_number,
            'assignment_description' => $request->assignment_description,
            'status' => $request->status,
            'class_room_id' => $request->class_room_id,
            'teacher_id' => $request->teacher_id,
            'kindergarten_id' => $request->kindergarten_id,
            'manager_id' => $request->manager_id,
            'subject_id' => $request->subject_id,
            'kindergarten_id' => $request->kindergarten_id,
        ]);

//        dailyNotification::create([
//            'title' => "مهمة جديدة",
//            'type' => "homework",
//            'student_id'=> $homeWork->id
//        ]);
             return new \App\Http\Resources\Mobile\Stff\HomeWork($homeWork);
    }

    public function listHomeWork($class_room){
        return new HomeWorks(Homework::class_room_id($class_room)->with('subject')->get());
    }

    public function listSubjectHomeWork($class_room,$subject_id){
        return new HomeWorks(Homework::subject_id($class_room,$subject_id)->orderBy('created_at', 'desc')->get());
    }


    public function thsub($id){
        $s = Teacher::where('id',$id)->with('subjects')->get();
        return $s[0]->subjects;
    }

}
