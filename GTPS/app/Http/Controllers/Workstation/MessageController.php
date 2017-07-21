<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-11
     * Time: 11:20
     */

    namespace App\Http\Controllers\Workstation;

    class MessageController extends Workstation
    {
        public function __construct()
        {
            parent::__construct();
        }
        /**
         * @SWG\Get(
         *   path="/workstation/message/manage",
         *   tags={"视图请求"},
         *   produces={"text/html"},
         *   summary="消息管理页",
         *   description="获取消息管理页视图",
         *   @SWG\Response(
         *     response=200,
         *     description="返回视图数据"
         *   )
         * )
         */
        public function manage()
        {
            return view('Workstation.Message.manage');
        }
    }