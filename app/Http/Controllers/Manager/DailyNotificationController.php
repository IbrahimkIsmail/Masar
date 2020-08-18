<?php

namespace App\Http\Controllers\Manager;

use App\Http\Resources\Dashboard\DaliyNotifications;
use App\Model\dailyNotification;
use App\Http\Controllers\Controller;

class DailyNotificationController extends Controller
{

    public function index($student_id){
        return new DaliyNotifications(dailyNotification::student_id($student_id)->get());
    }
}
