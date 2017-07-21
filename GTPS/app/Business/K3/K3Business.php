<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-19
     * Time: 14:35
     */

    namespace App\Business\K3;

    use App\Business\Business;

    abstract class K3Business extends Business
    {
        public function __construct()
        {
            parent::__construct();
        }

        /**
         * 获取待同步的数据列表
         *
         * @param string      $area       区域
         * @param string|null $start_time 开始时间
         * @param string|null $end_time   结束时间
         *
         * @return array
         */
        abstract public function getInputList(string $area, string $start_time = null, string $end_time = null);
    }