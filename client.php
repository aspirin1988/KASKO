<?php

    $client  = new \SoapClient(null, array(
        'location'=>'http://localhost:8000/soap',
        'uri'=>'http://localhost:8000/soap',
    ));

    $result = $client->getPrice(/*"Mercedes-Benz","E 200","2014"*/);

    print_r($result);