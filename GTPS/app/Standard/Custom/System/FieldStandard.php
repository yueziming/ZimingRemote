<?php
    /**
     * Created by PhpStorm.
     * User: 1671
     * Date: 2017-7-20
     * Time: 11:00
     */

    namespace App\Standard\Custom\System;

    interface FieldStandard
    {

        /**
         * 获取字段列表
         *
         * @return array
         * */
        public function getList();

        /**
         * 获取字段列表以及其对应的数据
         *
         * @return array
         * */
        public function getListData();
    }