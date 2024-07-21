<?php

use Illuminate\Support\Facades\Http;

class RequestUtil
{
    public static function get($url, $parameters = []){
        $response = Http::withHeaders(['Content-Type' => 'application/json'])->get($url, $parameters);
    }
}
