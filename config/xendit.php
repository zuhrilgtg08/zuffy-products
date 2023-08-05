<?php 

    return [
        'key_auth' => base64_encode(env('SECRET_XENDIT_API_KEY') . ':'),
    ];