<?php

namespace App\Http\Controllers\Mobile\Stff;

use App\Http\Resources\Dashboard\Notifications;
use App\Http\Resources\Mobile\Stff\Teacher;
use App\Http\Resources\Dashboard\ClassRooms;
use App\Http\Resources\Mobile\Students;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\ClassRoom;
use App\Model\Student;
use App\Model\Notification;

use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function Profile($id){
        return new Teacher(\App\Model\Teacher::id($id)->with('profile')->with('classRoom')->get());
    }

    Public function EditProfile(Request $request,$id){

        $profile = \App\Model\TeacherProfile::teacher_id($id)->first();
         $profile->full_address = $request->full_address;
         $profile->university_name = $request->university_name;
         $profile->specialty = $request->specialty;
         $profile->university_rate = $request->university_rate;
         $profile->year_of_graduation = $request->year_of_graduation;
         $profile->dob = $request->dob;
         $profile->image = $request->image;
         $profile->social_status = $request->social_status;
         $profile->courses = $request->courses;
         $profile->skills = $request->skills;
         $profile->languages = $request->languagess;
         $profile->update();
         return new Teacher(\App\Model\Teacher::id($profile->id)->with('profile')->get());
    }

    public function teacherClassRoom(){
        $teacher = Auth()->user();
        $teacher_class_rooms = $teacher->classRoom;
        return new ClassRooms($teacher_class_rooms);
    }

    public function classRoomStd($class_room){

        $ss =  ClassRoom::find($class_room);

        $std = ClassRoom::where('id',$class_room)->with('student')->first();
        return new ClassRooms($ss->student); //new Students();
    }

    public function sendNotif(Request $request){
        $validator = Validator::make($request->all(), [
            'kindergarten_id' => 'required',
            'manager_id' => 'required',
            'father_id' => 'required',
            'student_id' => 'required',
            'teacher_id' => 'required',
            'from_father' => 'required',
            'notification_type' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $not = Notification::create([
            'kindergarten_id' => $request->kindergarten_id,
            'manager_id' => $request->manager_id,
            'father_id' => $request->father_id,
            'student_id' => $request->student_id,
            'teacher_id' => $request->teacher_id,
            'from_father' => $request->from_father,
            'notification_type' => $request->notification_type,
            'description' => $request->description,
        ]);

       return $not;
    }

    Public function fatherNotification($id){
        return new Notifications(Notification::where('student_id',$id)->orderBy('created_at', 'desc')->get());
    }
}
