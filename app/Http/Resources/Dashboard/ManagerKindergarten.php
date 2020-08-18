<?php

namespace App\Http\Resources\Dashboard;

use App\Http\Resources\Dashboard\Kindergarten;
use Illuminate\Http\Resources\Json\JsonResource;

class ManagerKindergarten extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'ps_id' => $this->ps_id,
            'dob' => $this->dob,
            'image' => $this->image,
            'mobile_number' => $this->mobile_number,
            'full_address' => $this->full_address,
            'kindergarten' =>new Kindergarten($this->kindergarten)
        ];
//        return parent::toArray($request);
    }
}
