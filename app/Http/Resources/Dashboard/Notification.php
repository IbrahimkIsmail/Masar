<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class Notification extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

//
//            switch ($this->notification_type) {
//                case 0:
//                    $notification_type = 'complaint';
//                    break;
//                case 1:
//                    $notification_type = 'inquiry';
//                    break;
//                case 2:
//                    $notification_type = 'apology';
//                    break;
//                case 3:
//                    $notification_type = 'invitation';
//                    break;
//                case 4:
//                    $notification_type = 'payment_notification';
//                    break;
//                case 5:
//                    $notification_type = 'others';
//                    break;
//            }
//
//        return[
//            'from_father' => $this->from_father,
//            'notification_type' => $notification_type,
//            'description' => $this->description,
//        ];
            return parent::toArray($request);
    }
}
