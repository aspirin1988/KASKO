<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class СarList extends Model
{
    public $timestamps = true;

    protected $guarded = array();

    public static function getFormData ()
    {
        $mark=self::distinct('mark')->get();
        $model=[]/*self::distinct('model')->get()*/;
        $year=[]/*self::distinct('year')->get()*/;
        return ['mark'=>$mark,'model'=>$model,'year'=>$year];
    }
}
