<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'ps_id' => $this->ps_id,
            'name' => $this->name,
            'dob' => $this->dob,
            'kindergarten_id' => $this->kindergarten_id,
            'manager_id' => $this->manager_id,
            'father' => new Father($this->father),
            'teacher' => new Teacher($this->teacher),

        ];
//        return parent::toArray($request);
    }
}
