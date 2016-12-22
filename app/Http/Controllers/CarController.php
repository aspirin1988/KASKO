<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\СarList;
    use App\ReadyData;

    class CarController extends Controller{

        public function getCarPrice (Request $request)
        {

            $car = СarList::where ( 'mark', $request->input ( 'mark' ) )->where ( 'model', $request->input ( 'model' ) )
                          ->where ( 'year', $request->input ( 'year' ) )->first ();

            $find = $request->all ();
            unset( $find[ '_token' ] );

            if ( $car ){

                $data = ReadyData::where ( 'car_id', $car->id )->orderBy ( 'date', 'DESC' )->first ();
                if ( $data ){
                    $data->car_name = $data->getCarName ();
                }
                if ( $car && $data ){
                    return view ( "price.find", [ 'data' => $data, 'find' => $find ] );
                }
                else{
                    return view ( "price.nofind", [ 'find' => $find ] );
                }
            }

            return view ( "price.nofind", [ 'find' => $find ] );

        }

        public function addCarForm ()
        {
            return view('car.form');
        }

        public function getCarPriceApi (Request $request)
        {
            $request=$request->all();
//            return response()->json($request);
            unset($request['_token']);
            $car=СarList::where ( function ($querys) use ($request){
                foreach ($request as $key=>$value){
                    if ($value){
                        $querys->where($key,$value);
                    }
                }
            } )->first();
            if ( $car ){

                $data = ReadyData::where ( 'car_id', $car->id )->orderBy ( 'date', 'DESC' )->first ();
                if ( $data ){
                    $data->car_name = $data->getCarName ();
                }
                if ( $car && $data ){
                    return $data;
                }
                else{
                    return response ()->json ( [ 'error' => 1, "message" => "Sorry, car not found!" ] );
                }
            }

            return response ()->json ( [ 'error' => 1, "message" => "Sorry, car not found!" ] );

        }

        public function getMark ()
        {
            $mark = СarList::select('mark')->distinct( 'mark' )->get ();
            return response ()->json ( $mark );
        }

        public function getModel (Request $request)
        {
            $model = СarList::select('model')->distinct( 'model' )->where('mark',$request->input('mark'))->get ();
            return response ()->json ( $model );
        }

        public function getYear (Request $request)
        {
            $year = СarList::select('year')->distinct( 'year' )->where('mark',$request->input('mark'))->where('model',$request->input('model'))->get ();
            return response ()->json ( $year );
        }
    }
