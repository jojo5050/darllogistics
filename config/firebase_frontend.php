<?php

if (!function_exists('firebase_frontend_config')) {
    function firebase_frontend_config()
    {
        return [
            "apiKey"            => env("FIREBASE_API_KEY"),
            "authDomain"        => "darl-dispatch.firebaseapp.com",
            "projectId"         => "darl-dispatch",
            "storageBucket"     => "darl-dispatch.appspot.com",
            "messagingSenderId" => "276224518042",
            "appId"             => "1:276224518042:web:7a0abf25db2a3019737c23",
        ];
    }
}