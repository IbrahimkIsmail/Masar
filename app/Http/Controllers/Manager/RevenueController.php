<?php

namespace App\Http\Controllers\Manager;

use App\Http\Resources\Dashboard\Revenues;
use App\Model\Revenue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RevenueController extends Controller
{
    public function  __construct (){
        $this->middleware('kindergarten');
    }
    public function index()
    {
        $revenues = Auth::guard('manager')->user()->kindergarten->revenues;

        return new Revenues($revenues);
    }
    public function store(Request $request)
    {

        $managerAuth = Auth::guard('manager')->user();
        $validator = Validator::make($request->all(), [
            'value' => 'required',
            'for' =>'required',
            'description' => 'required',
            'date' => 'required',
            'voucher_number' => 'required',
            'bond_book_serial' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $revenue = new Revenue();
        $revenue->manager_id = $managerAuth->id;
        $revenue->kindergarten_id = $managerAuth->kindergarten->id;
        $revenue->serial_number = '#book-' . $request->bond_book_serial . '#page-' . $request->voucher_number;// #book-bond_book_serial#page-voucher_number
        $revenue->value = $request->value;
        $revenue->issue = $request->issue;
        $revenue->date = $request->date;
        $revenue->description = $request->description;

        $revenue->save();
        if (!$revenue ) {
            return response()->json(['error' => 'error while save data, check your internet'], 500);
        } else {
            return response()->json(['success_message' => 'created successfully']);
        }

    }

}
