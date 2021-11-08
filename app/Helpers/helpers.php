<?php

function send_resonse($message, $data) {
    $data = array('status' => true, 'response' => array('message' => $message, 'detail' => $data));
    return response()->json($data);
}

function send_error($message,$messages=[], $httpcode = 404) {
    $data = array(
        'status' => false,
        'message' => array('message' => $message)
    );

    !empty($messages) ? $data['errors'] = $messages : null;

    return response()->json($data, $httpcode);
}
