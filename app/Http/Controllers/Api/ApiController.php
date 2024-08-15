<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function response($date = [],$status = true, $message = "load sucess"){

        return response()->json([
            "status" => $status,
            "message" => $message,
            "data" => $date,
        ]);
    }
}
