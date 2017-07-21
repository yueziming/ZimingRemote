<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-13
     * Time: 10:51
     */

    namespace App\Http\Controllers\Workstation;

    use App\Business\ClientBusiness;
    use App\Model\System\Field;
    use Illuminate\Http\Request;

    class FieldController extends Workstation
    {
        public function __construct()
        {
            parent::__construct();
        }

        /**
         * 获取客户字段列表
         * @SWG\Get(
         *   path="/workstation/client/get-field-list",
         *   tags={"表单提交", "获取数据请求"},
         *   summary="获取客户字段列表",
         *   description="输出客户表的字段信息，包含是否可见，是否必填，是否可搜索的信息",
         *   @SWG\Response(
         *     response="default",
         *     description="返回字段列表",
         *   )
         * )
         *
         * @param Request $request
         *
         * @return array
         */
        public function getClientList(Request $request)
        {
            $client_business = new ClientBusiness($request);
            $result          = $client_business->getFieldList(new Field());

            return $result;
        }
    }