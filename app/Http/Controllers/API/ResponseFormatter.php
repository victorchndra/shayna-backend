<?php

namespace App\Http\Controllers\API;

class ResponseFormatter
{
    protected static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'success',
            'message' => null,
        ],
        'data' => null
    ];

    // static biar bisa titik 2 (tdk prlu obj) ResponseFormatter::success
    public static function success($data = null, $message = null)
    {
        // menyimpan message dgn parameter
        // self : digunakan pada static, biasanya $this->
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;

        // generate array/obj ke dalam json (ud dari laravelnya).
        return response()->json(self::$response, self::$response['meta']['code']);
    }

    public static function error($data = null, $message = null, $code = 400)
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;
        self::$response['data']= $data;

        return response()->json(self::$response, self::$response['meta']['code']);
    }
}
