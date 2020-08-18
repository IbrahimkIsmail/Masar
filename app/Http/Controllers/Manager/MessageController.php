<?php

namespace App\Http\Controllers\Manager;

use App\Http\Resources\Dashboard\Messages;
use App\Model\CommunicationChannel;
use App\Model\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function  __construct (){
        $this->middleware('kindergarten');
    }
    public function index()
    {
        $managerAuth = Auth::guard('manager')->user();
        $communicationChannel = $managerAuth->communicationChannels;

        return new Messages($communicationChannel);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $managerAuth = Auth::guard('manager')->user();
        $kindergarten = $managerAuth->kindergarten;
        $communicationChannel = CommunicationChannel::create([
            'message' => $request->message,
            'status'=>0,
            'kindergarten_id'=>$kindergarten->id,
            'manager_id'=>$managerAuth->id,
            'student_id'=>$request->student_id,
            'from_student' => 0
        ]);
        return response()->json(['success_message' => 'تمت']);

    }
    public function show($student_id)
    {
        $student = Student::find($student_id);
        $messages = $student->communicationChannels;

        return new Messages($messages);
    }

}
