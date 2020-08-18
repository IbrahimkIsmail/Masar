<?php

namespace App\Http\Controllers\Mobile\Stff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\DailyRatingRecord;

class RatingController extends Controller
{
    public function notifAll(Request $request){
          return DailyRatingRecord::get();

    }

}
