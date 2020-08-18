<?php

namespace App\Http\Controllers\Manager;

use App\Model\RegisterOfFinancialInstallment;
use App\Model\Revenue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterOfFinancialIlnstallment extends Controller
{

    public function  __construct (){
        $this->middleware('kindergarten');
    }
    function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'student_id' => 'required',
            'for' => 'required',
            'value' => 'required',
            'description' => 'required',
            'voucher_number' => 'required',
            'bond_book_serial' => 'required'

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $managerAuth = Auth::guard('manager')->user();
        $kindergarten = $managerAuth->kindergarten;
        if (!empty($request->value)) {
            $re = new RegisterOfFinancialInstallment();
            $re->value = $request->value;
            $re->for = '0';
            $re->description = $request->description;
            $re->student_id =  $request->student_id;
            $re->kindergarten_id = $kindergarten->id;
            $re->manager_id = $managerAuth->id;
            $re->voucher_number = $request->voucher_number;
            $re->bond_book_serial = $request->bond_book_serial;
            $re->save();


            $revenue = new Revenue();
            $revenue->date = $re->updated_at;
            $revenue->serial_number = '#book-' . $request->bond_book_serial . '#page-' . $request->voucher_number;// #book-bond_book_serial#page-voucher_number
            $revenue->value = $request->value;
            $revenue->for = '0';
            $revenue->description = $request->description;
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

}
