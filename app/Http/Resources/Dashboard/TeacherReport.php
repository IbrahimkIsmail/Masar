<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class TeacherReport extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->staffAttendance != null) {
            $teacher_attendance = $this->staffAttendance->whereBetween('created_at', [$request->from, $request->to]);
            if ($teacher_attendance != null) {
                $count_teacher_attendance = count($teacher_attendance);
            } else {
                $count_teacher_attendance = 0;
            }
        } else {
            $count_teacher_attendance = 0;
        }
        $total_attendance_days = Auth::guard('manager')->user()->kindergarten->kindergartenSettings->total_attendance_days;
        return [
            'name' => $this->name,
            'image' => $this->image,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'count_teacher_attendance' => $count_teacher_attendance,
            'total_attendance_days' => $total_attendance_days,
            'sub' => $total_attendance_days - $count_teacher_attendance,
        ];
    }
}
