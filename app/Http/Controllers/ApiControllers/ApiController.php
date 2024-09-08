<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function response( $data, $message = 'loaded successfully', $status = true )
    {
        $error_message   = 'failed to load';
        return Response()->json( [
                    'status'    => $status ? 1 : 0,
                    'message'   => $message ? $message : $error_message,
                    'data'      => $data,
                ] );
    }
}
