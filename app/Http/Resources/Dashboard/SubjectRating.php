<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectRating extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'student' => new Student(\App\Model\Student::find($request->student_id)),
            'rating' => $this->rating,
            'subject_id' => new Subject(\App\Model\Subject::find($request->subject_id))
        ];
        //return parent::toArray($request);
    }
}
