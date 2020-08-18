<?php

namespace App\Http\Controllers\Manager;

use App\Http\Resources\Dashboard\Expenses;
use App\Model\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    public function  __construct (){
        $this->middleware('kindergarten');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Expenses
     */
    public function index()
    {
        $expenses = Auth::guard('manager')->user()->kindergarten->expenses;

        return new Expenses($expenses);
    }
    public function store(Request $request)
    {
        $managerAuth = Auth::guard('manager')->user();
        $validator = Validator::make($request->all(), [
            'value' => 'required',
            'issue' =>'required',
            'description' => 'required',
            'date' => 'required',
            'voucher_number' => 'required',
            'bond_book_serial' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $expense = new Expense();
        $expense->manager_id = $managerAuth->id;
        $expense->kindergarten_id = $managerAuth->kindergarten->id;
        $expense->serial_number = '#book-' . $request->bond_book_serial . '#page-' . $request->voucher_number;// #book-bond_book_serial#page-voucher_number
        $expense->value = $request->value;
        $expense->issue = $request->issue;
        $expense->date = $request->date;
        $expense->description = $request->description;

        $expense->save();
        if (!$expense ) {
            return response()->json(['error' => 'error while save data, check your internet'], 500);
        } else {
            return response()->json(['success_message' => 'created successfully']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


}
