<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RegisterOfFinancialIlnstallments extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        // 0 => Educational fees
        // 1 => Transportation charges
        // 2 => Entertainment fees
        // 3 => others
//    $for = 'Educational fees';
//        switch ($request->for) {
//            case 0;
//                $for = 'Educational fees';
//                break;
//            case 1;
//                $for = 'Transportation charges';
//                break;
//            case 2;
//                $for = 'Entertainment fees';
//                break;
//            case 3;
//                $for = 'others';
//                break;
//
//        }
//
//        return [
//            'value' => $request->value,
//            'description' => $request->description,
//            'for' => $for,
//            'voucher_number' => $request->voucher_number,
//            'bond_book_serial' => $request->bond_book_serial,
//        ];
        return parent::toArray($request);
    }
}
