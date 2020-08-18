<?php

namespace App\Http\Controllers\Mobile\Stff;

use App\Http\Resources\Mobile\Stff\Students;
use App\Model\Student;
use App\Model\StudentAttendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //
    public function allStudent($class_room){
        return new Students(Student::class_room_id($class_room)->get());
    }

    public function saveStudentAttendance(Request $request){
        $validator = Validator::make($request->all(), [
            'student_id'   => 'required',
            'class_room_id'  => 'required',
            'teacher_id' => 'required',
            'kindergarten_id'  => 'required',
            'manager_id'  => 'required',
            'status'  => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $homeWork = StudentAttendance::create([
            'student_id'   =>  $request->student_id,
            'class_room_id'  => $request->class_room_id,
            'teacher_id' => $request->teacher_id,
            'kindergarten_id'  => $request->kindergarten_id,
            'manager_id'  => $request->manager_id,
            'status'  => $request->status,
        ]);


       return response()->json(['data' => $homeWork,'alldata' => StudentAttendance::orderBy('created_at', 'desc')->get() ], 200);
    }
}
