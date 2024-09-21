<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function response( $data, string $message = 'Success', bool $status = true, int $statusCode = 200 )
    {
        return Response()->json( [
                    'status'    => $status ? 1 : 0,
                    'message'   => $message,
                    'data'      => $data,
        ], $statusCode );
    }
    
    public function successMessage( string $message = 'Success', bool $status = true, int $statusCode = 200 )
    {
        return Response()->json( [
                    'status'    => $status ? 1 :0,
                    'message'   => $message,
        ], $statusCode );
    }
    
    public function errorMessage( string $message = 'Error', bool $status = true, int $statusCode = 400 )
    {
        return Response()->json( [
                    'status'    => $status ? 1 :0,
                    'message'   => $message,
        ], $statusCode );
    }
}
