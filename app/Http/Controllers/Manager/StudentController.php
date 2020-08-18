<?php

namespace App\Http\Controllers\Manager;

use App\Http\Resources\Dashboard\Students;
use App\Model\Father;
use App\Model\RegisterOfFinancialInstallment;
use App\Model\Revenue;
use App\Model\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware('kindergarten');
    }

    public function index()
    {
        $managerAuth = Auth::guard('manager')->user();
        $kindergarten = $managerAuth->kindergarten;
        $students = \App\Model\Student::where('kindergarten_id', $kindergarten->id)->with('classRoom')->with('father')->get();
        return new Students($students);
    }

    public function store(Request $request)
    {
        $managerAuth = Auth::guard('manager')->user();
        $kindergarten = $managerAuth->kindergarten;
        $validator = Validator::make($request->all(), [
            'ps_id' => 'required',
            'name' => 'required',
            'dob' => 'required',
            'class_room_id' => 'required',
            'father_ps_id' => 'required',
            'father_dob' => 'required',
            'father_name' => 'required',
            'father_password' => 'required',
            'father_full_address' => 'required',
            'father_mobile_number' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        if (!empty(Father::where('ps_id', $request->father_ps_id)->first())) {
            $father_id = Father::where('ps_id', $request->father_ps_id)->first()->id;

            $this->createRegisterOfFinancialInstallment($request, $this->storeStudent($request, $managerAuth->id, $kindergarten->id, $father_id));

        } else {
            $managerAuth = Auth::guard('manager')->user();
            $kindergarten = $managerAuth->kindergarten;

            $father = new Father();

            $father->ps_id = $request->father_ps_id;
            $father->dob = $request->father_dob;
            $father->full_name = $request->father_name;
            $father->password = bcrypt($request->father_password);
            $father->full_address = $request->father_full_address;
            $father->mobile_number = $request->father_mobile_number;
            $father->kindergarten_id = $kindergarten->id;
            $father->save();
            if (!$father) {
                return response()->json(['error' => "هناك مشكلة باضافة الاب تفحص الانترنت لديك", 500]);
            }
            $this->createRegisterOfFinancialInstallment($request, $this->storeStudent($request, $managerAuth->id, $kindergarten->id, $father->id));

        }


        return response()->json(['success_message' => "created successfully"]);
    }

    public function show($id)
    {

        $student = \App\Model\Student::find($id);
        return new \App\Http\Resources\Dashboard\Student($student); // error
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'ps_id' => 'required',
            'name' => 'required',
            'dob' => 'required',
            'class_room_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $student = Student::find($id);

        $student->class_room_id = $request->class_room_id;
        $student->ps_id = $request->ps_id;
        $student->name = $request->name;
        $student->dob = $request->dob;
        $student->save();

        if (!$student) {
            return response()->json(['error' => "لم يتم تعديل البيانات ربما هناك مشكلة بالانترنت لديك", 500]);
        }
        return response()->json(['success_message' => "تم تعديل البيانات بنجاح"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $father = Father::find($student->father->id);
        $sum_of_father_students = count($student->father->students);
        if ($sum_of_father_students == 1) {
            $father->delete();
        }
        $student->delete();

        return response()->json(['success_message' => "deleted successfully"]);

    }


    private function createRegisterOfFinancialInstallment($request, $student_id)
    {
        $managerAuth = Auth::guard('manager')->user();
        $kindergarten = $managerAuth->kindergarten;
        if (!empty($request->r_value)) {
            $re = new RegisterOfFinancialInstallment();
            $re->value = $request->r_value;
            $re->for = '0';
            $re->description = $request->r_description;
            $re->student_id = $student_id;
            $re->kindergarten_id = $kindergarten->id;
            $re->manager_id = $managerAuth->id;
            $re->voucher_number = $request->r_voucher_number;
            $re->bond_book_serial = $request->r_bond_book_serial;
            $re->save();


            $revenue = new Revenue();
            $revenue->date = $re->updated_at;
            $revenue->serial_number = '#book-' . $request->r_bond_book_serial . '#page-' . $request->r_voucher_number;// #book-bond_book_serial#page-voucher_number
            $revenue->value = $request->r_value;
            $revenue->for = '0';
            $revenue->description = $request->r_description;
            $revenue->kindergarten_id = $kindergarten->id;
            $revenue->manager_id = $managerAuth->id;
            if (!$re) {
                return response()->json(['error' => "لم يتم تخزين الدفعة المالية ربما هناك مشكلة بالانترنت لديك", 500]);
            }
            $revenue->save();
            if (!$revenue) {
                return response()->json(['error' => "لم يتم تخزين الدفعة المالية في الايرادات ربما هناك مشكلة بالانترنت لديك", 500]);
            }
        }
        return response()->json(['success_message' => 'تمت الاضافة بشكل ناجح ']);
    }

    private function storeStudent(Request $request, $managerAuthId, $kindergartenId, $father_id)
    {

        $student = new Student();
        $student->ps_id = $request->ps_id;
        $student->name = $request->name;
        $student->dob = $request->dob;
        $student->father_id = $father_id;
        $student->class_room_id = $request->class_room_id;
        $student->kindergarten_id = $kindergartenId;
        $student->manager_id = $managerAuthId;
        $student->save();
        if (!$student) {
            return response()->json(['error' => "لم يتم تسجيل الطالب ربما هناك مشكلة بالانترنت لديك", 500]);
        }
        return $student->id;
    }

}
