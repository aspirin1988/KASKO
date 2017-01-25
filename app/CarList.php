<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarList extends Model
{
    public $table = 'car_lists';
    public static function getFormData ()
    {
        $mark=self::select('mark')->distinct('mark')->get();
        $model=[]/*self::distinct('model')->get()*/;
        $year=[]/*self::distinct('year')->get()*/;
        return ['mark'=>$mark,'model'=>$model,'year'=>$year];
    }
}
