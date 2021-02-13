<?php

namespace App\Http\Traits;

trait JsonResponse
{
    public function jsonResponse($status, $message = [], $error = null, $data = null)
    {
        return response()->json([
            'status'    =>  $status,
            'message'    =>  $message,
            'error'    =>  $error,
            'data'    =>  $data,
        ]);
    }
}
