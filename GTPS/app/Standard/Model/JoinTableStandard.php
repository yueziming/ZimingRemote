<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-14
     * Time: 10:02
     */

    namespace App\Standard\Model;

    use App\Standard\Standard;

    interface JoinTableStandard extends Standard
    {
        public function __construct();

        /**
         * 获取表名
         *
         * @return string
         */
        public function getTable();
    }