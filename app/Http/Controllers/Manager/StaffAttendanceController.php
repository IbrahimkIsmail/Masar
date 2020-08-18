<?php

namespace App\Http\Controllers\Manager;

use App\Http\Resources\Dashboard\TeachersAttendance;
use App\Model\StaffAttendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StaffAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('kindergarten');
    }

    /**
     * Display a listing of the resource.
     *
     * @return TeachersAttendance
     */
    public function index()
    {
        $managerAuth = Auth::guard('manager')->user();
        $kindergarten = $managerAuth->kindergarten;

        $teachersAttendance = StaffAttendance::with('teacher')->get()->where('kindergarten_id',$kindergarten->id);
        return new TeachersAttendance($teachersAttendance);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $managerAuth = Auth::guard('manager')->user();
        $kindergarten = $managerAuth->kindergarten;
        $teachers = $kindergarten->teachers;
        $teachers_ids = [];
        foreach ($teachers as $index => $teacher) {
            $teachers_ids[$index] = $teacher->id;
        }
        foreach ($teachers_ids as $teacher_id) {
            if (in_array($teacher_id, $request->id)) {
                StaffAttendance::create([
                    'manger_id' => $managerAuth->id,
                    'kindergarten_id' => $kindergarten->id,
                    'teacher_id' => $teacher_id,
                    'status' => 1,
                ]);
            } else {
                StaffAttendance::create([
                    'manger_id' => $managerAuth->id,
                    'kindergarten_id' => $kindergarten->id,
                    'teacher_id' => $teacher_id,
                    'status' => 0,
                ]);
            }
        }
        return response()->json(['success_message' => 'created successfully']);

    }

    public function update(Request $request, $teacher_id)
    {
        $stf = StaffAttendance::find($teacher_id);
//        return $request;
        if (isset($request->not)) {
            $stf->status = 0;
            $stf->save();
        } elseif (isset($request->yes)) {
            $stf->status = 1;
            $stf->save();
        } else {
            return response()->json(['error' => 'error while save data, check your internet'], 500);
        }
        return response()->json(['success_message' => 'updated successfully']);

    }


}
