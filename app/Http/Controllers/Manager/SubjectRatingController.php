<?php

namespace App\Http\Controllers\Manager;

use App\Http\Resources\Dashboard\SubjectRatings;
use App\Model\Notification;
use App\Model\SubjectRating;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SubjectRatingController extends Controller
{
    public function  __construct (){
        $this->middleware('kindergarten');
    }
    public function index($student_id,$subject_id,$lastDay){
        $datas = Carbon::now()->subDays($lastDay)->format('Y-m-d')." 00:00:00";
        $dataf = Carbon::now()->format('Y-m-d')." 23:59:59";
       // $from = date('2019-07-31' . ' 00:00:00', time()); //need a space after dates.
        //$to = date('2019-07-31' . ' 14:14:29', time());
        $current = SubjectRating::where('student_id',$student_id)->where('subject_id',$subject_id)
            ->whereBetween('created_at', array($datas, $dataf))->get();
        return new SubjectRatings($current);
    }

    public function store(Request $request)
    {

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
        $SubjectRating = SubjectRating::create([
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'kindergarten_id' => $request->kindergarten_id,
            'rating' => $request->rating,
        ]);

        return new \App\Http\Resources\Dashboard\SubjectRating($SubjectRating);
    }

    public function current(){
        $from = date('Y-m-d' . ' 00:00:00', time()); //need a space after dates.
        $to = date('Y-m-d' . ' 24:60:60', time());

        $current = Connection::
        where('user_id',$this->user_id)
            ->where('status','active')
            ->whereBetween('created_at', array($from, $to))->first();

        return $current;
    }
}
