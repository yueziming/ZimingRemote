<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-11
     * Time: 17:40
     */

    namespace App\Http\Controllers\Workstation;

    use App\Business\ClientBusiness;
    use App\Http\Requests\ClientRequest;
    use Illuminate\Http\Request;

    class ClientController extends Workstation
    {
        private $_selfBusiness  = null;
        private $_httpRequest = null;

        public function __construct(Request $request)
        {
            parent::__construct();
            $this->_selfBusiness  = new ClientBusiness($request);
            $this->_httpRequest = $request;
        }

        /**
         * @SWG\Get(
         *   path="/workstation/client/manage",
         *   tags={"视图请求"},
         *   produces={"text/html"},
         *   summary="客户管理页",
         *   description="获取客户管理页视图",
         *   @SWG\Response(
         *     response=200,
         *     description="返回视图数据"
         *   )
         * )
         */
        public function manage()
        {
            return view('Workstation.Client.manage');
        }

        /**
         * @SWG\Get(
         *   path="/workstation/client/get-list",
         *   tags={"表单提交", "获取数据请求"},
         *   produces={"application/json"},
         *   summary="获取客户列表",
         *   description="获取客户列表数据",
         *   @SWG\Response(
         *     response=200,
         *     description="返回客户里表"
         *   )
         * )
         */
        public function getList()
        {
            return $this->_selfBusiness->getList();
        }

        /**
         * @SWG\Get(
         *   path="/workstation/client/detail/{client_id}",
         *   tags={"视图请求"},
         *   produces={"text/html"},
         *   summary="客户详情页",
         *   description="获取客户详情页视图",
         *   @SWG\Parameter(
         *     name="client_id",
         *     in="path",
         *     description="客户ID",
         *     required=true,
         *     type="integer"
         *   ),
         *   @SWG\Response(
         *     response=200,
         *     description="返回视图数据"
         *   )
         * )
         * @param int $client_id
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function detail(int $client_id)
        {
            return view('Workstation.Client.detail');
        }

        /**
         * @SWG\Post(
         *   path="/workstation/client/save",
         *   tags={"创建数据请求", "表单提交"},
         *   produces={"application/json"},
         *   summary="创建客户信息",
         *   description="创建客户数据",
         *   @SWG\Parameter(
         *     name="name",
         *     in="formData",
         *     description="名称",
         *     required=true,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="organization_id",
         *     in="formData",
         *     description="会所ID",
         *     required=true,
         *     type="integer"
         *   ),
         *   @SWG\Parameter(
         *     name="birthday",
         *     in="formData",
         *     description="生日",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="mobile",
         *     in="formData",
         *     description="手机号",
         *     required=true,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="email",
         *     in="formData",
         *     description="邮箱号",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="qq",
         *     in="formData",
         *     description="QQ",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="constellation",
         *     in="formData",
         *     description="星座",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="blood_group",
         *     in="formData",
         *     description="血型",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="gender",
         *     in="formData",
         *     description="性别",
         *     required=true,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="level",
         *     in="formData",
         *     description="等级",
         *     required=true,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="nationality",
         *     in="formData",
         *     description="国籍",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="religion",
         *     in="formData",
         *     description="宗教",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="race",
         *     in="formData",
         *     description="种族",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="identity_card",
         *     in="formData",
         *     description="身份证号",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="profession",
         *     in="formData",
         *     description="职业",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="unit",
         *     in="formData",
         *     description="工作单位",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="province",
         *     in="formData",
         *     description="省",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="city",
         *     in="formData",
         *     description="市",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="county",
         *     in="formData",
         *     description="县/区",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="address",
         *     in="formData",
         *     description="地址",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="agent",
         *     in="formData",
         *     description="媒介",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="type",
         *     in="formData",
         *     description="类型",
         *     required=true,
         *     type="string"
         *   ),
         *   @SWG\Parameter(
         *     name="comment",
         *     in="formData",
         *     description="备注",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Response(
         *     response=200,
         *     description="返回结果数据，{status:bool, message:string, data:mixed}"
         *   )
         * )
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function save(ClientRequest $request)
        {
//            $result = $this->_selfBusiness->save($this->_httpRequest->all()); ChenYanWen 2017-7-20 10:40 添加验证
            $result = $this->_selfBusiness->save($request->all());

            return $result;
        }
    }