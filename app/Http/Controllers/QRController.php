<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\http\Response;
use Endroid\QrCode\QrCode;

class QRController extends Controller
{
    public function index() {
        $data = array(
            'nombre'  => 'Jose',
            'apellido' => 'Gutierrez',
            'codigo' => 1600505505,
        );
        $qrCode = new QrCode(json_encode($data));
        header('Content-Type: '.$qrCode->getContentType());
        $response = new Response($qrCode->writeString(), 200);
        $response->header('content-type', 'image/png');
        return $response;
    }

}
