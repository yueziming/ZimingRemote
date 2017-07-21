<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-14
     * Time: 15:09
     */

    namespace App\Http\Controllers\Workstation;

    class MemberController extends Workstation
    {
        public function __construct()
        {
            parent::__construct();
        }

        /**
         * @SWG\Get(
         *   path="/workstation/member/manage",
         *   tags={"视图请求"},
         *   produces={"text/html"},
         *   summary="会员管理页",
         *   description="获取会员管理页视图",
         *   @SWG\Response(
         *     response=200,
         *     description="返回视图数据"
         *   )
         * )
         */
        public function manage()
        {
            return view('Workstation.Member.manage');
        }
    }