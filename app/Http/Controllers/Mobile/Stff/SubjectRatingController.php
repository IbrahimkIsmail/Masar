<?php

namespace App\Http\Controllers\Mobile\Stff;

use App\Http\Resources\Mobile\SubjectRatings;
use App\Model\Homework;
use App\Model\SubjectRating;
use App\Model\DailyRatingRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SubjectRatingController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'kindergarten_id' => 'required',
            'rating' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $rating = SubjectRating::create([
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'kindergarten_id' => $request->kindergarten_id,
            'rating' => $request->rating,
        ]);

        return new \App\Http\Resources\Mobile\Stff\SubjectRating($rating);
    }

    public function dailyRetingRecord(Request $request){
        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'personal_appearance'=> 'required',
            'personal_hygiene' => 'required',
            'child_behavior' => 'required',
            'violence' => 'required',
            'excellence' => 'required',
            'child_health' => 'required',
            'interaction_level' => 'required',
            'learning_level' => 'required',
            'teacher_id' => 'required',
            'kindergarten_id' => 'required',
            'manager_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $rating = DailyRatingRecord::create([
            'student_id' => $request->student_id,
            'personal_appearance'=> $request->personal_appearance,
            'personal_hygiene' => $request->personal_hygiene,
            'child_behavior' => $request->child_behavior,
            'violence' => $request->violence,
            'excellence' => $request->excellence,
            'child_health' => $request->child_health,
            'interaction_level' => $request->interaction_level,
            'learning_level' => $request->learning_level,
            'teacher_id' => $request->teacher_id,
            'kindergarten_id' => $request->kindergarten_id,
            'manager_id' => $request->manager_id,
        ]);

        return new \App\Http\Resources\Mobile\Stff\SubjectRating($rating);

    }

    public function dailyRetingRecordList($std_id){
        $rating = DailyRatingRecord::where('student_id',$std_id)->orderBy('created_at', 'desc')->get();
        return new \App\Http\Resources\Mobile\Stff\SubjectRatings($rating);

    }

    public function subjectRetingRecordList($std_id){
         $rating = SubjectRating::where('student_id',$std_id)->orderBy('created_at', 'desc')->get();
         return new SubjectRatings($rating);
    }
}
