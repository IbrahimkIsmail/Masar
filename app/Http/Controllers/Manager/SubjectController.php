<?php

namespace App\Http\Controllers\Manager;

use App\Http\Resources\Dashboard\Subjects;
use App\Model\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    public function  __construct (){
        $this->middleware('kindergarten');
    }
    public function index(){
          //return 1;
        return new Subjects(Subject::all());
    }

    public function store(Request $request){

    }

    public function update(){
    }
}
