<?php

namespace App\Http\Controllers\Manager;

use App\Http\Resources\Dashboard\Fathers;
use App\Http\Resources\Dashboard\Students;
use App\Model\Father;
use App\Model\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FatherController extends Controller
{
    public function  __construct (){
        $this->middleware('kindergarten');
    }
    public function index(){
        $managerAuth = Auth::guard('manager')->user();
        $kindergarten = $managerAuth->kindergarten;
        return new Fathers(Father::kindergarten_id($kindergarten->id)->get());
    }

    public function getStudentByFatherId($id){
        return new Students(Student::father_id($id)->get());
    }
}
