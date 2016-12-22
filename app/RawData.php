<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RawData extends Model
{
    public $timestamps = true;

    protected $guarded = array();

    public function getCarName ()
    {
        $data = СarList::where('id',$this->car_id)->first();
        return $data;
    }
}
