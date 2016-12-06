<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\СarList;
    use App\ReadyData;

    class CarController extends Controller{

        public function getCarPrice (Request $request)
        {

            $car = СarList::where ( 'mark', $request->input ( 'mark' ) )
                    ->where ( 'model', $request->input ( 'model' ) )
                    ->where ( 'year', $request->input ( 'year' ) )
                    ->first ();

            $find=$request->all();
            unset($find['_token']);

            if ( $car ){

                $data = ReadyData::where ( 'car_id', $car->id )
                        ->orderBy ( 'date','DESC' )
                        ->first ();
                if ($data){
                    $data->car_name = $data->getCarName ();
                }
                if ($car && $data){
                    return view ( "price.find", [ 'data' => $data, 'find' => $find ] );
                }else{
                    return view("price.nofind",['find'=>$find]);
                }
            }
            return view("price.nofind",['find'=>$find]);

        }

        public function getCarPriceApi (Request $request)
        {

            $car = СarList::where ( 'mark', $request->input ( 'mark' ) )
                          ->where ( 'model', $request->input ( 'model' ) )
                          ->where ( 'year', $request->input ( 'year' ) )
                          ->first ();

            $find=$request->all();
            unset($find['_token']);

            if ( $car ){

                $data = ReadyData::where ( 'car_id', $car->id )
                                 ->orderBy ( 'date','DESC' )
                                 ->first ();
                if ($data){
                    $data->car_name = $data->getCarName ();
                }
                if ($car && $data){
                    return response()->json($data);
                }else{
                    return response()->json(['error'=>1,"message"=>"Sorry, car not found!"]);
                }
            }
            return response()->json(['error'=>1,"message"=>"Sorry, car not found!"]);

        }
    }
