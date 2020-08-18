<?php

namespace App\Http\Controllers\Manager;

use App\Http\Resources\Dashboard\ClassRooms;
use App\Http\Resources\Dashboard\Notifications;
use App\Model\ClassRoom;
use App\Model\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function  __construct (){
        $this->middleware('kindergarten');
    }
    public function index($student_id)
    {
        return new Notifications(Notification::student_id($student_id)->get());
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kindergarten_id' => 'required',
            'manager_id' => 'required',
            'father_id' => 'required',
            'student_id' => 'required',
            'from_father' => 'required',
            'notification_type' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $notification = Notification::create([
            'kindergarten_id' => $request->kindergarten_id,
            'manager_id' => $request->manager_id,
            'father_id' => $request->father_id,
            'student_id' => $request->student_id,
            'from_father' => $request->from_father,
            'notification_type' => $request->notification_type,
            'description' => $request->description,
        ]);

        return new \App\Http\Resources\Dashboard\Notification($notification);
    }


}
