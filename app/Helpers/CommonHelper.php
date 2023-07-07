<?php

function sendSuccess($message, $data = [], $responseCode = 200) {
    return response([
        'success' => true,
        'message' => $message,
        'responsecode' => $responseCode,
        'data' => $data,
    ], $responseCode);
}

function sendError($message, $data = [] ,$responseCode = 200) {
     return response([
        'success' => false,
        'message' => $message,
        'responsecode' => $responseCode,
        'data' => $data,
    ], $responseCode);
}

function sendInternalSuccess($message, $data = [], $responseCode = 200) {
    return array(
        'success' => true,
        'message' => $message,
        'responsecode' => $responseCode,
        'data' => $data,
    );
}

function sendInternalError($message, $data = [] ,$responseCode = 200) {
     return array(
        'success' => false,
        'message' => $message,
        'responsecode' => $responseCode,
        'data' => $data,
    );
}
