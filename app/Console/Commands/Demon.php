<?php

    namespace App\Console\Commands;

    use App\CarList;
    use App\RawData;
    use App\ReadyData;
    use Illuminate\Console\Command;

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
                $count = RawData::where( 'car_id', $car->id )->count();
                $summ  = RawData::where( 'car_id', $car->id )->sum( 'price' );
                if( $count ) {

                    $data  = RawData::select( 'price' )->where( 'car_id', $car->id )->where( 'price', '>', $summ / $count )->orderBy( 'price', 'ASC' )->sum( 'price' );
                    $count = RawData::select( 'price' )->where( 'car_id', $car->id )->where( 'price', '>', $summ / $count )->orderBy( 'price', 'ASC' )->count();

                    if( $count )
                        ReadyData::create( [ 'car_id' => $car->id, 'price' => $data / $count, 'date' => date( 'Y-m-d H:i:s' ) ] );
                }
            }
            RawData::truncate();
        }
    }
