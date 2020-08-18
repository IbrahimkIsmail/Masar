<?php

namespace App\Http\Controllers\Manager;

use App\Http\Resources\Dashboard\KindergartenSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KindergartenController extends Controller
{
    public function  __construct (){
        $this->middleware('kindergarten');
    }
    function index(){
        $kindergarten = Auth::guard('manager')->user()->kindergarten;
        $settings = $kindergarten->kindergartenSettings;

        return new KindergartenSettings($settings);
    }
    function store(Request $request)
    {
        $kindergarten = Auth::guard('manager')->user()->kindergarten;
        $settings = $kindergarten->kindergartenSettings;
        $validator = Validator::make($request->all(), [
            'total_attendance_days' => 'required',
            'teacher_salary' => 'required',
            'education_fees' => 'required',
            'transportation_charges' => 'required',
            'entertainment_fees' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $settings::create([
            'kindergarten_id' => $kindergarten->id,
            'total_attendance_days' => $request->total_attendance_days,
            'teacher_salary' => $request->teacher_salary,
            'education_fees' => $request->education_fees,
            'transportation_charges' => $request->transportation_charges,
            'entertainment_fees' => $request->entertainment_fees,
        ]);
        return response()->json(['success_message' => 'stored successfully']);

    }
    function update(Request $request)
    {
        $kindergarten = Auth::guard('manager')->user()->kindergarten;
        $settings = $kindergarten->kindergartenSettings;
        $validator = Validator::make($request->all(), [
            'total_attendance_days' => 'required',
            'teacher_salary' => 'required',
            'education_fees' => 'required',
            'transportation_charges' => 'required',
            'entertainment_fees' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $settings::update([
            'kindergarten_id' => $kindergarten->id,
            'total_attendance_days' => $request->total_attendance_days,
            'teacher_salary' => $request->teacher_salary,
            'education_fees' => $request->education_fees,
            'transportation_charges' => $request->transportation_charges,
            'entertainment_fees' => $request->entertainment_fees,
        ]);
        return response()->json(['success_message' => 'updated successfully']);

    }
}
