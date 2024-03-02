<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse($result, $code = 200)
    {
        $response = [
            'data' => $result,
        ];
        return response()->json($response, $code);
    }

    public function sendError($errorMessage, $code = 500)
    {
        $response = [
            'message' => $errorMessage,
        ];
        return response()->json($response, $code);
    }
}
