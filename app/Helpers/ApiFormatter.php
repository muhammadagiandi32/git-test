<?php

namespace App\Helpers;

class ApiFormatter
{
    protected static $response = [
        'status' => null,
        'message' => null,
        'data' => null,
    ];

    public static function CallBackApi($status = null, $message = null, $data = null)
    {
        self::$response['status'] = $status;
        self::$response['message'] = $message;
        self::$response['data'] = $data;

        return response()->json(self::$response, self::$response['status']);
    }
}
