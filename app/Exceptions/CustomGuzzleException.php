<?php
namespace App\Exceptions;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;

trait CustomGuzzleException {
    private $message;
    private $statusCode;
    private $error;

    public function translateException($exception) {
        if($exception instanceof ServerException) {
            $this->message = "server error";
            // dd($exception);
            return response()->json([
                'message' => 'The server is not responding to the request.',
                'errors' => [
                    'internal_server' => [
                        'The server might be on maintenance mode.'
                    ]
                ],
                'code' => 500
            ], 500);
        }
        else if($exception instanceof ConnectException) {
            if($exception->getHandlerContext()['errno'] == 28) {
                return response()->json([
                    'message' => 'The server is not responding to the request.',
                    'errors' => [
                        'connect' => [
                            'The server might be on maintenance mode.'
                        ]
                    ],
                    'code' => 500
                ], 500);
                // $this->getErrorResponse(
                //     'The server is not responding to the request.', 
                //     'internal_server', 
                //     'The server might be on maintenance mode.', 
                //     500);
            }
        }
    }

    public function getErrorResponse($message, $param, $param_message, $error_code) {
        return response()->json([
            'message' => $message,
            'errors' => [
                $param => [
                    $param_message
                ]
            ],
            'code' => $error_code
        ], $error_code);
    }


}