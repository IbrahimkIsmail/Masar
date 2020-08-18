<?php

namespace App\Http\Controllers\Manager;

use App\Http\Resources\Dashboard\KindergartenFinancialReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManagerReportController extends Controller
{
    public function  __construct (){
        $this->middleware('kindergarten');
    }
    function showKindergartenFinancialReport(Request $request){
        $kindergarten = Auth::guard('manager')->user()->kindergarten;


       $revenuesEducationalFees =$kindergarten->revenues->where('for',0)->sum('value') ;
       $revenuesTransportationCharges =$kindergarten->revenues->where('for',1)->sum('value') ;
       $revenuesEntertainmentFees =$kindergarten->revenues->where('for',2)->sum('value') ;
       $revenuesExternalSupport =$kindergarten->revenues->where('for',3)->sum('value') ;
       $revenuesOthers =$kindergarten->revenues->where('for',4)->sum('value') ;

        $expensesEntertainmentAllowance =$kindergarten->expenses->where('issue',0)->sum('value') ;
        $expensesPurchaseAllowance =$kindergarten->expenses->where('issue',1)->sum('value') ;
        $expensesRentAllowance =$kindergarten->expenses->where('issue',2)->sum('value') ;
        $expensesLicense =$kindergarten->expenses->where('issue',3)->sum('value') ;
        $expensesEquivalents =$kindergarten->expenses->where('issue',4)->sum('value') ;
        $expensesSalaries =$kindergarten->expenses->where('issue',5)->sum('value') ;
        $expensesElectricity =$kindergarten->expenses->where('issue',6)->sum('value') ;
        $expensesWater =$kindergarten->expenses->where('issue',7)->sum('value') ;
        $expensesSanitation =$kindergarten->expenses->where('issue',8)->sum('value') ;
        $expensesMaintenance =$kindergarten->expenses->where('issue',9)->sum('value') ;
        $expensesOthers =$kindergarten->expenses->where('issue',10)->sum('value') ;


        return new KindergartenFinancialReport($kindergarten);

    }
}
