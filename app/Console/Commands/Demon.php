<?php

    namespace App\Console\Commands;

    use App\CarList;
    use App\RawData;
    use App\ReadyData;
    use Illuminate\Console\Command;
    use Illuminate\Support\Facades\DB;

    class Demon extends Command
    {
        /**
         * The name and signature of the console command.
         *
         * @var string
         */
        protected $signature = 'demon:start';

        /**
         * The console command description.
         *
         * @var string
         */
        protected $description = 'Command description';

        /**
         * Create a new command instance.
         *
         * @return void
         */
        public function __construct()
        {
            parent::__construct();
        }

        /**
         * Execute the console command.
         *
         * @return mixed
         */
        public function handle()
        {
            $cars = CarList::get();
            foreach( $cars as $key => $car ) {
                echo $car->id."\n";
                $data  = RawData::select( 'price' )
                    ->where( 'car_id', $car->id )
                    ->get();
                $count = RawData::where( 'car_id', $car->id )->count();
                if( $count > 1 ) {
                    $summ  = [];
                    $summ1 = [];
                    foreach( $data as $key1 => $value ) {
                        $summ[] = $value->price;
                    }
                    asort( $summ );
                    foreach( $summ as $key1 => $value ) {
                        $summ1[] = $value;
                    }
                    $result = false;
                    if( count( $count ) % 2 ) {
                        $a      = ceil( count( $summ1 ) / 2 ) - 1;
                        $b      = $a + 1;
                        $result = ceil( ( $summ1[ $a ] + $summ1[ $b ] ) / 2 );
                    }
                    else {
                        $a = ceil( count( $summ1 ) / 2 );
                        $result = $summ1[ $a ];
                    }
                    echo $result."\n"."count:".$count.":".($count%2)."\n";

                    if( $result ) {
                        ReadyData::create( [ 'car_id' => $car->id, 'price' => $result, 'date' => date( 'Y-m-d H:i:s' ) ] );
                    }
                }
                else{
                    ReadyData::create( [ 'car_id' => $car->id, 'price' => $data[0]->price, 'date' => date( 'Y-m-d H:i:s' ) ] );
                    echo $data[0]->price."\n"."count:".$count.":".($count%2)."\n";

                }
            }
//            RawData::truncate();
        }
    }
