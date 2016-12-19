<?php

namespace App;


class KascoSoapServer
{

    public function getOptions ()
    {

    }

    public function getPrice ($mark="Toyota",$model="Camry",$year="2004")
    {
        $car = СarList::where ( 'mark', $mark )
                      ->where ( 'model', $model )
                      ->where ( 'year', $year )
                      ->first ();

        return $car->toArray();
    }
}
