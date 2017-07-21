<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-3
     * Time: 15:56
     */

    namespace App\Data;

    class Time
    {
        /**
         * 获取当前时间
         *
         * @return false|string
         */
        public static function getCurrentTime()
        {
            return date('Y-m-d H:i:s');
        }

        /**
         * 获取当前时间戳
         *
         * @return int
         */
        public static function getCurrentTimestamp()
        {
            return time();
        }

        /**
         * 判定是否满足时间格式
         *
         * @param string $str
         *
         * @return null|string
         */
        public static function filterTimeFormat(string $str)
        {
            $temp = strtotime($str);
            if($temp === false) return null;
            $temp = date('Y-m-d H:i:s', $temp);

            return $temp;
        }

        /**
         * 判定是否满足日期格式
         *
         * @param string $str
         *
         * @return null|string
         */
        public static function filterDateFormat(string $str)
        {
            $temp = strtotime($str);
            if($temp === false) return null;
            $temp = date('Y-m-d', $temp);

            return $temp;
        }
    }