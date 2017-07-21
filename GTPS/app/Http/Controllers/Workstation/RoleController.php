<?php

    namespace App\Http\Controllers\Workstation;

    use App\Business\RoleBusiness;
    use Illuminate\Http\Request;

    class RoleController extends Workstation
    {
        private $_selfBusiness  = null;
        private $_httpRequest = null;

        public function __construct(Request $request)
        {
            parent::__construct();
            $this->_selfBusiness  = new RoleBusiness();
            $this->_httpRequest = $request;
        }

        /**
         * 角色管理页
         * @SWG\Get(
         *   path="/workstation/role/manage",
         *   tags={"视图请求"},
         *   summary="角色管理页",
         *   description="获取角色管理页面视图",
         *   produces={"text/html"},
         *   @SWG\Response(
         *     response=200,
         *     description="返回视图数据"
         *   )
         * )
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
         */
        public function manage()
        {
            return view('Workstation.Role.manage');
        }

        /**
         * 获取角色列表
         * @SWG\Get(
         *   path="/workstation/role/get-list",
         *   tags={"表单提交", "获取数据请求"},
         *   summary="获取角色列表",
         *   description="输出包含分组信息的角色列表",
         *   @SWG\Response(
         *     response="default",
         *     description="返回角色列表",
         *   )
         * )
         *
         * @return array
         */
        public function getList()
        {
            $result = $this->_selfBusiness->getListWithGroup();

            return $result;
        }

        /**
         * 通过用户ID获取角色列表
         * @SWG\Get(
         *   path="/workstation/user/get-role-by-user/{user_id}",
         *   tags={"表单提交", "获取数据请求"},
         *   summary="获取用户的角色列表",
         *   description="输出指定用户分配的所有角色",
         *   @SWG\Parameter(
         *     name="user_id",
         *     in="path",
         *     description="用户ID",
         *     required=true,
         *     type="integer"
         *   ),
         *   @SWG\Response(
         *     response="default",
         *     description="返回角色列表",
         *   )
         * )
         *
         * @param int $user_id 用户ID
         *
         * @return array
         */
        public function getListByUser(int $user_id)
        {
            $list = $this->_selfBusiness->getListByUser($user_id);

            return $list;
        }

        /**
         * 通过角色ID获取权限列表
         * @SWG\Get(
         *   path="/workstation/role/get-permission/{role_id}",
         *   tags={"表单提交", "获取数据请求"},
         *   summary="获取角色的权限列表",
         *   description="输出指定角色授权的所有权限",
         *   @SWG\Parameter(
         *     name="role_id",
         *     in="path",
         *     description="角色ID",
         *     required=true,
         *     type="integer"
         *   ),
         *   @SWG\Response(
         *     response="default",
         *     description="返回权限列表",
         *   )
         * )
         *
         * @param int $role_id 角色ID
         *
         * @return array
         */
        public function getPermission(int $role_id)
        {
            $result = $this->_selfBusiness->getPermission($role_id);

            return $result;
        }

        /**
         * 收回角色授权
         * @SWG\Patch(
         *   path="/workstation/role/revoke/{role_id}",
         *   tags={"表单提交", "局部修改数据请求"},
         *   summary="收回角色授权",
         *   description="收回角色授权",
         *   @SWG\Parameter(
         *     name="role_id",
         *     in="path",
         *     description="角色ID",
         *     required=true,
         *     type="integer"
         *   ),
         *   @SWG\Parameter(
         *     name="permission",
         *     in="formData",
         *     description="权限ID串（若有多个，每个权限ID用半角逗号**,**分隔。例：**34,54,76**）",
         *     required=true,
         *     type="string"
         *   ),
         *   @SWG\Response(
         *     response="default",
         *     description="返回{status:bool, message:string}格式数据",
         *   )
         * )
         *
         * @param int     $role_id 角色ID
         *
         * @return array
         */
        public function revoke(int $role_id)
        {
            $permission      = $this->_httpRequest->get('permission', '');
            $permission_list = explode(',', $permission);
            $result          = $this->_selfBusiness->revoke($role_id, $permission_list);

            return $result;
        }

        /**
         * 角色授权
         * @SWG\Post(
         *   path="/workstation/role/grant/{role_id}",
         *   tags={"表单提交", "创建数据请求"},
         *   summary="角色授权",
         *   description="角色授权",
         *   @SWG\Parameter(
         *     name="role_id",
         *     in="path",
         *     description="角色ID",
         *     required=true,
         *     type="integer"
         *   ),
         *   @SWG\Parameter(
         *     name="permission",
         *     in="formData",
         *     description="权限ID串（若有多个，每个权限ID用半角逗号**,**分隔。例：**34,54,76**）",
         *     required=true,
         *     type="string"
         *   ),
         *   @SWG\Response(
         *     response="default",
         *     description="返回{status:bool, message:string}格式数据",
         *   )
         * )
         *
         * @param int     $role_id 角色ID
         *
         * @return array
         */
        public function grant( int $role_id)
        {
            $permission      = $this->_httpRequest->get('permission', '');
            $permission_list = explode(',', $permission);
            $result          = $this->_selfBusiness->grant($role_id, $permission_list);

            return $result;
        }
    }
