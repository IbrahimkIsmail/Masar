<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    // النفقات
    protected $fillable = [
        'date', // date of document need
        'serial_number',
        'value',
        'issue',
        'kindergarten_id',
        'manager_id',
        'description'
    ];

    //inverse of one to many relation

    public function kindergarten()
    {
        return $this->belongsTo('App\Model\Kindergarten');
    }//end of kindergarten relation

    public function manager()
    {
        return $this->belongsTo('App\Model\Manager');
    }//end of manager relation


    //end of inverse of one to many relation


}
