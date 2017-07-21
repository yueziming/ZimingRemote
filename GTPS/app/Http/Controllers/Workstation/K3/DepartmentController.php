<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-19
     * Time: 9:23
     */

    namespace App\Http\Controllers\Workstation\K3;

    use App\Business\K3\DepartmentBusiness;
    use Illuminate\Http\Request;

    class DepartmentController extends K3
    {
        private $_selfBusiness = null;

        public function __construct(DepartmentBusiness $department_business)
        {
            parent::__construct();
            $this->_selfBusiness = $department_business;
        }

        /**
         * @SWG\Get(
         *   path="/workstation/k3/department",
         *   tags={"视图请求"},
         *   produces={"text/html"},
         *   summary="K3部门同步页",
         *   description="坐标视图部门数据同步到K3的页面",
         *   @SWG\Response(
         *     response=200,
         *     description="返回视图数据"
         *   )
         * )
         */
        public function sync()
        {
            return view('Workstation.K3.department');
        }

        /**
         * 获取部门待同步的数据
         * @SWG\Get(
         *   path="/workstation/k3/department/get-input-list/{area}",
         *   tags={"表单提交", "获取数据请求"},
         *   summary="获取部门待同步的数据",
         *   description="从坐标视图获取部门待同步到金蝶的数据",
         *   @SWG\Parameter(
         *     name="area",
         *     in="path",
         *     description="区域",
         *     required=true,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="start_time",
         *     in="query",
         *     description="开始时间",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="end_time",
         *     in="query",
         *     description="结束时间",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Response(
         *     response="default",
         *     description="返回部门数据列表",
         *   )
         * )
         *
         * @param Request $request
         * @param string  $area 区域
         *
         * @return array
         */
        public function getInputList(Request $request, string $area)
        {
            $start_time = $request->get('start_time');
            $end_time   = $request->get('end_time');
            $result     = $this->_selfBusiness->getInputList($area, $start_time, $end_time);

            return $result;
        }

        public function save(){

        }

    }
