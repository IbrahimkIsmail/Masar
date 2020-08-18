<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherFinancialReport extends JsonResource
{

    public function toArray($request)
    {

        if (count($this->salaries) != 0) {
            $teacher_salaries = $this->salaries->whereBetween('payment_date', [$request->from, $request->to]);
            if (count($teacher_salaries) != 0) {
               $t_salaries = new Salaries($this->salaries);
            } else {
                $t_salaries = "no salary";
            }
        } else {
            $t_salaries = "no salary";
        }

        return [
            'name' => $this->name,
            'ps_id' => $this->ps_id,
            'status' => $this->status == 1 ? "مثبتة" : "غير مثبتة",
            'salaries' => $t_salaries
        ];
    }
}
