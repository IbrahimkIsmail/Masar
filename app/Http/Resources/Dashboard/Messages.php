<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class Messages extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

//        $managerAuth = Auth::guard('manager')->user();
//        $kindergarten = $managerAuth->kindergarten;
//        $students = $kindergarten->students;
//        return [
//            'message' => $this->message,
//            'status' => $this->status,
//            'kindergarten_id' => $this->kindergarten_id,
//            'manager_id' => $this->manager_id,
//            'from_student' => $this->from_student,
//            'student_id' => $this->student_id,
//        ];
        return parent::toArray($request);
    }
}
