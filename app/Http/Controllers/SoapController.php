<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\KascoSoapServer;
use SoapServer;

class SoapController extends Controller
{

    public function index (Request $request)
    {
        $server = new \SoapServer(null, array(
            'uri' => 'http://localhost:8000/soap'
        ));
        $server->setClass('App\KascoSoapServer');

        $response = new Response();
        $response->headers->set("Content-Type","text/xml; charset=utf-8");

        ob_start();
        $server->handle();
        $response->setContent(ob_get_clean());

        return $response;
    }
}
