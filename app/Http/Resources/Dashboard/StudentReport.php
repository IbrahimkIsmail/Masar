<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class StudentReport extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->studentAttendances != null) {
            $student_attendance = $this->studentAttendances->whereBetween('created_at', [$request->from, $request->to]);
            if ($student_attendance != null) {
                $count_student_attendance = count($student_attendance);
            } else {
                $count_student_attendance = 0;
            }
        } else {
            $count_student_attendance = 0;
        }
        $total_attendance_days = Auth::guard('manager')->user()->kindergarten->kindergartenSettings->total_attendance_days;
        $daily_rating_record = $this->dailyRatingRecords->whereBetween('created_at', [$request->from, $request->to]);

        if ($daily_rating_record == null || (count($daily_rating_record) == 0)) {
            $personal_hygiene = 0;
            $personal_appearance = 0;
            $child_behavior = 0;
            $violence = 100;
            $excellence = 0;
            $level_interaction = 0;
            $child_health = 0;
        } else {
            $personal_appearance = intval((count($daily_rating_record->where('personal_appearance', 1)) / count($daily_rating_record)) * 100);
            $personal_hygiene = intval((count($daily_rating_record->where('personal_hygiene', 1)) / count($daily_rating_record)) * 100);
            $child_behavior = intval((count($daily_rating_record->where('child_behavior', 1)) / count($daily_rating_record)) * 100);
            $violence = intval(100 - (count($daily_rating_record->where('violence', 1)) / count($daily_rating_record)) * 100);
            $excellence = intval((count($daily_rating_record->where('excellence', 1)) / count($daily_rating_record)) * 100);
            $level_interaction = intval((count($daily_rating_record->where('level_interaction', 1)) / count($daily_rating_record)) * 100);
            $child_health = intval((count($daily_rating_record->where('child_health', 1)) / count($daily_rating_record)) * 100);

        }


        return [
            'ps_id' => $this->ps_id,
            'name' => $this->name,
            'dob' => $this->dob,
            'father_id' => $this->father_id,
            'class_room_id' => new ClassRoom(\App\Model\ClassRoom::find($this->class_room_id)),
            'total_attendance_days' => $total_attendance_days,
            'count_teacher_attendance' => $count_student_attendance,
            'sub' => $total_attendance_days - $count_student_attendance,
            'personal_appearance' => $personal_appearance,
            'personal_hygiene' => $personal_hygiene,
            'child_behavior' => $child_behavior,
            'violence' => $violence,
            'excellence' => $excellence,
            'level_interaction' => $level_interaction,
            'child_health' => $child_health,

        ];

//    /    return parent::toArray($request);
    }
}
