<?php

namespace App\Http\Controllers\Manager;

use App\Model\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('kindergarten');
    }
    public function showReport(Request $request)
    {
        $teacher = Teacher::find($request->teacher_id);
        return new \App\Http\Resources\Dashboard\TeacherReport($teacher);
    }

    public function showFinancialReport(Request $request)
    {
        $teacher = Teacher::find($request->teacher_id);
        return new \App\Http\Resources\Dashboard\TeacherFinancialReport($teacher);
    }

//
//    public function edit($id)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request $request
//     * @param  int $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        //
//    }
}
