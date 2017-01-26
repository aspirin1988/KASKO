<?php

    namespace App;


    class KascoSoapServer{

        public function getOptions ()
        {
            return [ 'asd' => 'test' ];
        }

        public function getPrice ($mark = null, $model = null, $year = null)
        {
            $query = [ 'mark' => $mark, 'model' => $model, 'year' => $year ];
            $car=CarList::where ( function ($querys) use ($query){
                foreach ($query as $key=>$value){
                    if ($value){
                        $querys->where($key,$value);
                    }
                }
            } )->get();
            $car=$car->toArray();
            return (!empty($car)?array_merge ([(count($car)>1?'results':'result')=>$car], [ 'query' => $query ] ):[ 'status' => 200, 'result' => false , 'query' => $query  ]);
        }
    }
