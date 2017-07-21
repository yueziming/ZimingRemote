<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-11
     * Time: 12:02
     */

    namespace App\Data;

    class Http
    {
        const STATUS_CODE = [
            // Informational 1xx
            100 => 'Continue',
            101 => 'Switching Protocols',
            102 => 'Processing', // extend
            // Success 2xx
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            207 => 'Multi Status',  // extend
            // Redirection 3xx
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Moved Temporarily ', // 1.1
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            307 => 'Temporary Redirect',
            // Client Error 4xx
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            421 => 'There are too many connections from your internet address',
            422 => 'Unprocessable Entity',
            423 => 'Locked',
            424 => 'Failed Dependency',
            425 => 'Unordered Collection',
            426 => 'Upgrade Required',
            449 => 'Retry With',
            451 => 'Unavailable For Legal Reasons',
            // Server Error 5xx
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            506 => 'Variant Also Negotiates',
            507 => 'Insufficient Storage',
            509 => 'Bandwidth Limit Exceeded',
            510 => 'Not Extended',
            600 => 'Unparseable Response Headers'
        ];

        /**
         * 对客户端指定HTTP状态码进行返回处理请求
         *
         * @param int $status_code
         */
        public static function handler(int $status_code)
        {
            if(array_key_exists($status_code, self::STATUS_CODE)){
                header("HTTP/1.1 $status_code ".self::STATUS_CODE[$status_code]);
                ob_flush();
                flush();
            }
        }
    }