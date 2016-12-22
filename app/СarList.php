<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class СarList extends Model
{
    public $timestamps = true;

    protected $guarded = array();

    public static function getFormData ()
    {

        return ['mark'=>$mark,'model'=>$model,'year'=>$year];
    }
}
