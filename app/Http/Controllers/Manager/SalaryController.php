<?php

namespace App\Http\Controllers\Manager;

use App\Model\Expense;
use App\Model\Salary;
use App\Model\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SalaryController extends Controller
{
// سند قبض
    public function  __construct (){
        $this->middleware('kindergarten');
    }

    public function store(Request $request)
    {
        $managerAuth = Auth::guard('manager')->user();
        $kindergarten = $managerAuth->kindergarten;
        $validator = Validator::make($request->all(), [
            'teacher_id' => 'required',
            'type' => 'required',
            'value' => 'required',
            'payment_date' => 'required',
            'voucher_number' => 'required',
            'bond_book_serial' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }


        $salary = new Salary();

        $salary->manger_id = $managerAuth->id;
        $salary->kindergarten_id = $kindergarten->id;
        $salary->teacher_id = $request->teacher_id;
        $salary->type = $request->type; // salary or award 0,->type;
        $salary->value = $request->value;
        $salary->payment_date = $request->payment_date;
        $salary->voucher_number = $request->voucher_number;
        $salary->bond_book_serial = $request->bond_book_serial;


        $salary_type = $request->type == 0 ? 'راتب' : 'مكافئة';
        $expense = new Expense();
        $expense->manager_id = $managerAuth->id;
        $expense->kindergarten_id = $managerAuth->kindergarten->id;
        $expense->serial_number = '#book-' . $request->bond_book_serial . '#page-' . $request->voucher_number;// #book-bond_book_serial#page-voucher_number
        $expense->value = $request->value;
        $expense->issue = 5;
        $expense->date = $request->payment_date;
        $expense->description = $salary_type . ' للمعلمة ' . Teacher::find($request->teacher_id)->name;

        $salary->save();
        $expense->save();
        if (!$salary || !$expense) {
            return response()->json(['error' => 'error while save data, check your internet'], 500);
        } else {
            return response()->json(['success_message' => 'created successfully']);
        }
    }
}
