<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

if (!function_exists('toSnakeCase')) {
    /**
     * @param $str
     * @return string
     */
    function toSnakeCase($str): string
    {
        $pattern = '/(?<=\\w)(?=[A-Z])|(?<=[a-z])(?=[0-9])/';
        $snakeCase = preg_replace($pattern, '_', $str);
        return strtolower($snakeCase);
    }
}

if (!function_exists('toLowerCase')) {
    /**
     * @param $str
     * @return string
     */
    function toLowerCase($str): string
    {
        return strtolower($str);
    }
}

if (!function_exists('toLowerFirst')) {
    /**
     * @param $str
     * @return string
     */
    function toLowerFirst($str): string
    {
        return strtolower($str);
    }
}

if (!function_exists('generateCodeReplaceName')) {
    /**
     * @param $str
     * @return string
     */
    function generateCodeReplaceName($str, $name): string
    {
        $str = str_replace("#name#", $name, $str); //DuyHung
        $str = str_replace("#nameSnake#", toSnakeCase($name), $str);//duy_hung
        $str = str_replace("#nameTable#", toSnakeCase($name) . 's', $str);//duy_hungs
        $str = str_replace("#nameLower#", toLowerCase($name), $str); //duyhung
        $str = str_replace("#nameLowerFirst#", toLowerFirst($name), $str); //duyHung

        return $str;
    }
}

if (!function_exists('existsFile')) {
    /**
     * @param $path
     * @return bool
     */
    function existsFile($path): bool
    {
        return File::exists($path);
    }
}

if (!function_exists('makeSlug')) {
    /**
     * @param $str
     * @return array|string|string[]|null
     * generate string slug frequency
     */
    function makeSlug($str)
    {
        $search = array(
            '#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
            '#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
            '#(ì|í|ị|ỉ|ĩ)#',
            '#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
            '#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
            '#(ỳ|ý|ỵ|ỷ|ỹ)#',
            '#(đ)#',
            '#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
            '#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
            '#(Ì|Í|Ị|Ỉ|Ĩ)#',
            '#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
            '#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
            '#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
            '#(Đ)#',
            "/[^a-zA-Z0-9\-\_]/",
        );
        $replace = array(
            'a',
            'e',
            'i',
            'o',
            'u',
            'y',
            'd',
            'A',
            'E',
            'I',
            'O',
            'U',
            'Y',
            'D',
            '-',
        );
        $string = preg_replace($search, $replace, $str);
        $string = preg_replace('/(-)+/', '-', $string);
        $string = strtolower($string);
        return $string;
    }
}

if (!function_exists('isEmail')) {
    /**
     * @param $email
     * @return false|int
     * This email regex is not fully RFC5322-compliant, but it will validate most common email address formats correctly.
     */
    function isEmail($email)
    {
        return preg_match('/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})*$/', $email);
    }
}

if (!function_exists('buildCategoryTree')) {
    function builderCategoryTree($categories, $parent_id = 0, $prefix = '')
    {
        $categoryTree = [];

        foreach ($categories as $category) {
            if ($category->parent_id == $parent_id) {
                $category->name = $prefix . $category->name;
                $categoryTree[] = $category;
                $categoryTree = array_merge($categoryTree, builderCategoryTree($categories, $category->id, $prefix . '__'));
            }
        }
        return $categoryTree;
    }
}

if (!function_exists('randomCode')) {
    function randomCode($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}


if (!function_exists('apiSuccessRes')) {
    function apiSuccessRes($data = [], $message = 'success', $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json(['data' => $data, 'message' => $message, 'success' => true], $status);
    }
}

if (!function_exists('apiPageRes')) {
    function apiPageRes(LengthAwarePaginator $page, $message = 'success', $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            [
                'data' => $page->items(),
                'metadata' => [
                    "page" => $page->currentPage(),
                    "size" => $page->perPage(),
                    "total" => $page->total(),
                    "totalPage" => $page->lastPage(),
                ],
                'message' => $message,
                'success' => true
            ], $status);
    }
}
if (!function_exists('apiErrorRes')) {
    function apiErrorRes($error = [], $message = 'error', $status = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json(['error' => $error, 'message' => $message, 'success' => false], $status);
    }
}

if (!function_exists('sendMessageTelegram')) {
    function sendMessageTelegram($token, $chatId, $message): void
    {
        $apiUrl = "https://api.telegram.org/bot$token/sendMessage?parse_mode=HTML";
        $body = [
            'chat_id' => $chatId,
            'text' => mb_convert_encoding($message, 'UTF-8', 'UTF-8'),
            "disable_notification" => false
        ];

        $response = Http::withHeaders(['Content-Type' => 'application/json'])->post($apiUrl, $body);
    }
}

if (!function_exists('toClientTime')) {
    function toClientTime($time) {
        if(Session::has('current_time_zone')){
            $current_time_zone = Session::get('current_time_zone');
            $time = $time->setTimezone($current_time_zone);
        }
        return $time;
    }
}

