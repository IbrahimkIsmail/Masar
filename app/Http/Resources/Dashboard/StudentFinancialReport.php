<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentFinancialReport extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       ;
//        dd($registerOfFinancialInstallments);
        return [
            'name' =>$this->name,
            'ps_id' =>$this->ps_id,
            'registerOfFinancialInstallments' =>  new RegisterOfFinancialIlnstallments($this->registerOfFinancialInstallments),

        ];
//        return parent::toArray($request);
    }
}
