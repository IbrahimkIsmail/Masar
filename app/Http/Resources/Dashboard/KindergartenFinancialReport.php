<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class KindergartenFinancialReport extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $kindergarten = $this;
        $revenues = $kindergarten->revenues->whereBetween('created_at', [$request->from, $request->to]);
        $revenuesEducationalFees = $revenues->where('for', 0)->sum('value');
        $revenuesTransportationCharges = $revenues->where('for', 1)->sum('value');
        $revenuesEntertainmentFees = $revenues->where('for', 2)->sum('value');
        $revenuesExternalSupport = $revenues->where('for', 3)->sum('value');
        $revenuesOthers = $revenues->where('for', 4)->sum('value');
        //        dd($revenues);
        $expenses = $kindergarten->expenses->whereBetween('created_at', [$request->from, $request->to]);
        $expensesEntertainmentAllowance = $expenses->where('issue', 0)->sum('value');
        $expensesPurchaseAllowance = $expenses->where('issue', 1)->sum('value');
        $expensesRentAllowance = $expenses->where('issue', 2)->sum('value');
        $expensesLicense = $expenses->where('issue', 3)->sum('value');
        $expensesEquivalents = $expenses->where('issue', 4)->sum('value');
        $expensesSalaries = $expenses->where('issue', 5)->sum('value');
        $expensesElectricity = $expenses->where('issue', 6)->sum('value');
        $expensesWater = $expenses->where('issue', 7)->sum('value');
        $expensesSanitation = $expenses->where('issue', 8)->sum('value');
        $expensesMaintenance = $expenses->where('issue', 9)->sum('value');
        $expensesOthers = $expenses->where('issue', 10)->sum('value');


        $expensesSum = $expensesEntertainmentAllowance +
            $expensesPurchaseAllowance +
            $expensesRentAllowance +
            $expensesLicense +
            $expensesEquivalents +
            $expensesSalaries +
            $expensesElectricity +
            $expensesWater +
            $expensesSanitation +
            $expensesMaintenance +
            $expensesOthers;
        $revenueSum = $revenuesEducationalFees +
            $revenuesTransportationCharges +
            $revenuesEntertainmentFees +
            $revenuesExternalSupport +
            $revenuesOthers;
        return [
            'name' => $kindergarten->name,
            'revenuesEducationalFees' => $revenuesEducationalFees,
            'revenuesTransportationCharges' => $revenuesTransportationCharges,
            'revenuesEntertainmentFees' => $revenuesEntertainmentFees,
            'revenuesExternalSupport' => $revenuesExternalSupport,
            'revenuesOthers' => $revenuesOthers,
            'revenueSum' => $revenueSum,
            'expensesEntertainmentAllowance' => $expensesEntertainmentAllowance,
            'expensesPurchaseAllowance' => $expensesPurchaseAllowance,
            'expensesRentAllowance' => $expensesRentAllowance,
            'expensesLicense' => $expensesLicense,
            'expensesEquivalents' => $expensesEquivalents,
            'expensesSalaries' => $expensesSalaries,
            'expensesElectricity' => $expensesElectricity,
            'expensesWater' => $expensesWater,
            'expensesSanitation' => $expensesSanitation,
            'expensesMaintenance' => $expensesMaintenance,
            'expensesOthers' => $expensesOthers,
            'expensesSum' => $expensesSum,
            'sub' => $revenueSum - $expensesSum,
        ];
        //        return parent::toArray($request);
    }
}
