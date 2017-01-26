<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadyData extends Model
{
    public $timestamps = true;

    protected $guarded = array();

    public function getCarName ()
    {
        $data = CarList::where('id',$this->car_id)->first();
        return $data;
    }
}
