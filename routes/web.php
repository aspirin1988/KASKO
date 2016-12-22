<?php

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | This file is where you may define all of the routes that are handled
    | by your application. Just tell Laravel the URIs it should respond
    | to using a Closure or controller method. Build something great!
    |
    */

    Route::get ( '/', function (){
        return view ( 'welcome' );
    } );

    Route::post ( '/api/find/car', 'CarController@getCarPriceApi' );
    Route::get ( '/api/get/mark', 'CarController@getMark' );
    Route::post ( '/api/get/model', 'CarController@getModel' );
    Route::post ( '/api/get/year', 'CarController@getYear' );

    Route::post ( '/soap', 'SoapController@index' );

    Auth::routes ();

    Route::get ( '/home', 'HomeController@index' );

    Route::post ( '/cars/price/get', 'CarController@getCarPrice' );
    Route::get ( '/cars/add', 'CarController@addCarForm' );

    Route::get ( '/scrapper', function (){
        $crawler = Goutte::request ( 'GET', 'https://auto.ru/catalog/all/' );
        $crawler->filter ( '.mosaic__p_size_m > a' )->each ( function ($node){
            print $node->text ()."<br>";
        } );
        //return view('welcome');
    } );



