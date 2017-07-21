<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-6-24
     * Time: 16:59
     */

    namespace App\Business;

    class Business
    {
        public function __construct()
        {
        }

        /**
         * 返回结果数据
         *
         * @param bool   $status  结果状态
         * @param string $message 提示信息
         * @param array  $option  额外信息
         *
         * @return array
         */
        protected static function returnResult(bool $status, string $message, array $option = [])
        {
            if(isset($option['status'])) unset($option['status']);
            if(isset($option['message'])) unset($option['message']);

            return array_merge(['status' => $status, 'message' => $message], $option);
        }
    }