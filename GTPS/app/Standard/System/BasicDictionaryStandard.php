<?php
    namespace App\Standard\System;

    use App\Standard\Standard;

    /**
     * 基础字典模型协议
     *
     * */
    interface BasicDictionaryStandard extends Standard
    {
        /** 获取列表 */
        public function getList();
    }