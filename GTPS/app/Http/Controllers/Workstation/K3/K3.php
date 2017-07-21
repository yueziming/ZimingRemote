<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-19
     * Time: 9:22
     */

    namespace App\Http\Controllers\Workstation\K3;

    use App\Http\Controllers\Workstation\Workstation;

    class K3 extends Workstation
    {

        public function __construct()
        {
            parent::__construct();
        }

        /**
         * @SWG\Get(
         *   path="/workstation/k3/get-area",
         *   tags={"表单提交", "获取数据请求"},
         *   summary="获取区域列表",
         *   description="输出已支持的区域列表",
         *   @SWG\Response(
         *     response="default",
         *     description="返回区域列表",
         *   )
         * )
         *
         * @return array
         */
    }