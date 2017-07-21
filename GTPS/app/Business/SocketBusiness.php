<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-8
     * Time: 14:59
     */

    namespace App\Business;

    use Illuminate\Support\Facades\Redis;

    class SocketBusiness extends Business
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function bind($socket_id, $user_id)
        {
            if(!$socket_id || !$user_id) $this::returnResult(false, '缺少必要参数');
            // todo 存到redis
            return $this::returnResult(false, '保存成功');
        }
    }