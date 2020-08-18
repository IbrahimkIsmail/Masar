<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [

        'amount',
        'manager_id',
        'kindergarten_id',
        'subscription_date',
        'expiration_date',
        'price_per_user',
//        'remaining_amount'
    ];//end of fillable
    /********/
//inverse one to many relation
    public function user()
    {
        return $this->belongsTo('App\User');
    }//end of user Relation
//end inverse one to many relation
    /**************************************/
//one to one relation
    public function manager()
    {
        return $this->belongsTo('App\Model\Manager');
    }

    public function kindergarten()
    {
        return $this->belongsTo('App\Model\Kindergarten');
    }
//end inverse one to one relation

}
