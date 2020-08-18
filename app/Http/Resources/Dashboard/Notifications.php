<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\ResourceCollection;

class Notifications extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//
//        switch ($request->notification_type) {
//            case 0:
//                $notification_type = 'complaint';
//                break;
//            case 1:
//                $notification_type = 'inquiry';
//                break;
//            case 2:
//                $notification_type = 'apology';
//                break;
//            case 3:
//                $notification_type = 'invitation';
//                break;
//            case 4:
//                $notification_type = 'payment_notification';
//                break;
//            case 5:
//                $notification_type = 'others';
//                break;
//        }
//        return[
//            'from_father' => $request->from_father,
//            'notification_type' => $notification_type,
//            'description' => $request->description,
//        ];
        return parent::toArray($request);

    }
}
