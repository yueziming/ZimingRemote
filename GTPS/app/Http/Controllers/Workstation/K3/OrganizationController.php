<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-19
     * Time: 14:25
     */

    namespace App\Http\Controllers\Workstation\K3;

    class OrganizationController extends K3
    {
        public function __construct()
        {
            parent::__construct();
        }

        /**
         * @SWG\Get(
         *   path="/workstation/k3/organization",
         *   tags={"视图请求"},
         *   produces={"text/html"},
         *   summary="K3会所同步页",
         *   description="坐标视图会所数据同步到K3的页面",
         *   @SWG\Response(
         *     response=200,
         *     description="返回视图数据"
         *   )
         * )
         */
        public function sync()
        {
            return view('Workstation.K3.organization');
        }
    }