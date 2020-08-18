<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'manger_id',
        'kindergarten_id',
        'teacher_id',
        'type', // salary or award 0,1
        'value',
        'payment_date',
        'voucher_number',
        'bond_book_serial',
        ];
    public function Manager(){
        return $this->belongsTo('App\Model\Manager');
    }

    public function Kindergarten(){
        return $this->belongsTo('App\Model\Kindergarten');
    }

    public function teacher(){
        return $this->belongsTo('App\Model\Teacher');
    }

}
