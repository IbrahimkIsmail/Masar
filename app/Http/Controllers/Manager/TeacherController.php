<?php

namespace App\Http\Controllers\Manager;


use App\Http\Resources\Dashboard\Teachers;
use App\Model\Subject;
use App\Model\Teacher;
use App\Model\TeacherProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{

    public function __construct()
    {
        $this->middleware('kindergarten');
    }

    public function index()
    {
        $managerAuth = Auth::guard('manager')->user();
        $kindergarten = $managerAuth->kindergarten;
        $teachers = $kindergarten->teachers;
        return new Teachers($teachers);
    }

    public function store(Request $request)
    {
        $managerAuth = Auth::guard('manager')->user();
        $managerAuthId = Auth::guard('manager')->user()->id;
        $kindergarten = $managerAuth->kindergarten;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'full_address' => 'required|string|max:191',
            'ps_id' => 'required',
            'mobile_number' => 'required',
            'status' => 'required',
            'dob' => 'required|date',
            'password' => 'required|string|min:8',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $teacher = Teacher::create([
            'kindergarten_id' => $kindergarten->id,
            'manager_id' => $managerAuthId,
            'name' => $request->name,
            'email' => $request->email,
            'ps_id' => $request->ps_id ."",
            'mobile_number' => $request->mobile_number,
            'status' => $request->status,
            'password' => bcrypt($request->password),

        ]);
        TeacherProfile::create([
            'teacher_id' => $teacher->id,
            'full_address' => $request->full_address,
            'dob' => $request->dob,
        ]);

        //moaz

        $subjects_ids = $request->subjects_ids;
        $teacher->subjects()->sync($subjects_ids);
        $classrooms_ids = $request->classrooms_ids;
        $teacher->classRoom()->sync($classrooms_ids);
        return response()->json(['success_message' => "created successfully"]);
    }

    public function destroy($id)
    {
        Teacher::find($id)->delete();
        return response()->json(['success_message' => "deleted successfully"]);
    }

    public function update(Request $request, $id)
    {

        $managerAuth = Auth::guard('manager')->user();
        $managerAuthId = Auth::guard('manager')->user()->id;
        $kindergartenId = $managerAuth->kindergarten->id;
        $teacher = Teacher::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'ps_id' => 'required',
            'mobile_number' => 'required',
            'status' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $teacher->name = $request->name;
//        $teacher->email = $request->email;
        $teacher->ps_id = $request->ps_id . "";
        $teacher->mobile_number = $request->mobile_number;
        $teacher->status = $request->status;

        $teacher->manager_id = $managerAuthId;
        $teacher->kindergarten_id = $kindergartenId;
//moaz
        $subjects_ids = $request->subjects_ids;
        $teacher->subjects()->sync($subjects_ids);
        $classrooms_ids = $request->classrooms_ids;
        $teacher->classRoom()->sync($classrooms_ids);
//        if (!empty($request->input('password'))) {
//            $teacher->password = bcrypt($request->password);
//        }
        $teacher->update();
        return response()->json(['success_message' => "updated successfully"]);
    }

    public function show($id)
    {
        $teacher = Teacher::find($id);
        $teacher->subjects;
        $teacher->classRoom;
        return new \App\Http\Resources\Dashboard\Teacher($teacher);
    }

}
