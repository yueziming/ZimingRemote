<?php

    namespace App\Http\Controllers\Workstation;

    use App\Business\UserBusiness;
    use App\Data\Session;
    use App\Http\Middleware\User\VerifyLogin;
    use Illuminate\Http\Request;

    class UserController extends Workstation
    {
        private $_selfBusiness  = null;
        private $_httpRequest = null;

        public function __construct(Request $request)
        {
            parent::__construct();
            $this->_httpRequest = $request;
            $this->_selfBusiness  = new UserBusiness($request);
        }

        /**
         * @SWG\Post(
         *   path="/login",
         *   tags={"表单提交", "创建数据请求"},
         *   summary="登录请求",
         *   produces={"application/json"},
         *   description="用于处理登入的提交请求",
         *   @SWG\Parameter(
         *     name="username",
         *     type="string",
         *     required=true,
         *     in="formData",
         *     description="用户名"
         *   ),
         *   @SWG\Parameter(
         *     name="password",
         *     type="string",
         *     required=false,
         *     in="formData",
         *     description="密码"
         *   ),
         *   @SWG\Response(
         *     response="default",
         *     description="返回{status:bool, message:string}格式数据"
         *   )
         * )
         */
        /**
         * @SWG\Get(
         *   path="/login",
         *   tags={"视图请求"},
         *   produces={"text/html"},
         *   summary="登入页面",
         *   description="获取登入页面视图",
         *   @SWG\Response(
         *     response=200,
         *     description="返回视图数据"
         *   )
         * )
         */
        /**
         * 用于处理登入GET和POST的路由分发
         **
         *
         * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|array
         */
        public function login()
        {
            $request_type = strtolower($this->_httpRequest->getRealMethod());
            switch($request_type){
                case 'get':
                    return view('Workstation.User.login');
                break;
                case 'post':
                    /** @noinspection PhpUndefinedFieldInspection */
                    if($this->_httpRequest->loginVerifyResult['status']){
                        // 将当前登入用户信息写入Session
                        /** @noinspection PhpUndefinedFieldInspection */
                        $result2 = $this->_selfBusiness->saveSession($this->_httpRequest->loginVerifyResult['data']);
                        if($result2['status']) $result2['message'] = '登入成功';
                        if($this->_httpRequest->ajax()) $result2['nextPage'] = route('index-after-login');
                        else return redirect()->route('index-after-login');

                        return $result2;
                    }
                    else{
                        if($this->_httpRequest->ajax()){
                            /** @noinspection PhpUndefinedFieldInspection */
                            return $this->_httpRequest->loginVerifyResult;
                        }
                        else{
                            /** @noinspection PhpUndefinedFieldInspection */
                            return self::failure('/login', $this->_httpRequest->loginVerifyResult['message'], 0);
                        }
                    }
                break;
                default:
                    return ['status' => false, 'message' => '错误的请求方式'];
                break;
            }
        }

        /**
         * 注销
         * @SWG\Delete(
         *   path="/logout",
         *   tags={"删除数据请求"},
         *   summary="注销",
         *   description="退出当前登入用户",
         *   produces={"application/json"},
         *   @SWG\Response(
         *     response=200,
         *     description="返回结果数据，{status:bool, data:array}"
         *   )
         * )
         *
         * @return array
         */
        public function logout()
        {
            $this->_selfBusiness->cleanSession();

            return ['status' => true, 'message' => '注销成功'];
            // return redirect()->route('login-page');
        }

        /**
         * 获取登入的用户
         * @SWG\Get(
         *   path="/get-login-user",
         *   tags={"表单提交", "获取数据请求"},
         *   summary="获取登入的用户",
         *   description="获取登入的用户信息和登入状态",
         *   produces={"application/json"},
         *   @SWG\Response(
         *     response=200,
         *     description="返回结果数据，{status:bool, data:array}"
         *   )
         * )
         *
         * @return array
         */
        public function getLoginUser()
        {
            return [
                'status' => VerifyLogin::isLogin($this->_httpRequest),
                'data'   => [
                    'id'   => $this->_httpRequest->session()->get(Session::LOGIN_USER_ID),
                    'name' => $this->_httpRequest->session()->get(Session::LOGIN_USER_NAME),
                    'code' => $this->_httpRequest->session()->get(Session::LOGIN_USER_CODE)
                ]
            ];
        }

        /**
         * 用户管理页
         * @SWG\Get(
         *   path="/workstation/user/manage",
         *   tags={"视图请求"},
         *   summary="用户管理页",
         *   description="获取用户管理页面视图",
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
            return view('Workstation.User.manage');
        }

        /**
         * 通过角色ID获取用户列表
         * @SWG\Get(
         *   path="/workstation/role/manage/get-user-by-role/{role_id}",
         *   tags={"表单提交", "获取数据请求"},
         *   summary="获取角色的用户列表",
         *   description="输出指定角色分配的所有用户",
         *   @SWG\Parameter(
         *     name="role_id",
         *     in="path",
         *     description="角色ID",
         *     required=true,
         *     type="integer"
         *   ),
         *   @SWG\Response(
         *     response="default",
         *     description="返回用户列表",
         *   )
         * )
         *
         * @param int $role_id 角色ID
         *
         * @return array
         */
        public function getListByRole(int $role_id)
        {
            $list = $this->_selfBusiness->getListByRole($role_id);

            return $list;
        }

        /**
         * 通过用户ID获取独立授权的权限列表
         * @SWG\Get(
         *   path="/workstation/user/get-permission/{user_id}",
         *   tags={"表单提交", "获取数据请求"},
         *   summary="获取用户的独立权限列表",
         *   description="输出指定用户独立授权的权限",
         *   @SWG\Parameter(
         *     name="user_id",
         *     in="path",
         *     description="用户ID",
         *     required=true,
         *     type="integer"
         *   ),
         *   @SWG\Response(
         *     response="default",
         *     description="返回权限列表",
         *   )
         * )
         *
         * @param int $user_id 角色ID
         *
         * @return array
         */
        public function getPermission(int $user_id)
        {
            $result = $this->_selfBusiness->getPermission($user_id);

            return $result;
        }

        /**
         * 通过用户ID获取该用户授权的所有权限列表
         * @SWG\Get(
         *   path="/workstation/user/manage/get-all-permission/{user_id}",
         *   tags={"表单提交", "获取数据请求"},
         *   summary="获取用户的所有的权限列表",
         *   description="输出指定用户授权的所有权限（包含角色授权的列表）",
         *   @SWG\Parameter(
         *     name="user_id",
         *     in="path",
         *     description="用户ID",
         *     required=true,
         *     type="integer"
         *   ),
         *   @SWG\Response(
         *     response="default",
         *     description="返回权限列表",
         *   )
         * )
         *
         * @param int $user_id 用户ID
         *
         * @return array
         */
        public function getAllPermission(int $user_id)
        {
            $result = $this->_selfBusiness->getAllPermission($user_id);

            return $result;
        }

        /**
         * 收回用户独立授权
         * @SWG\Patch(
         *   path="/workstation/user/revoke/{user_id}",
         *   tags={"表单提交", "局部修改数据请求"},
         *   summary="收回用户独立授权",
         *   description="收回用户独立授权",
         *   @SWG\Parameter(
         *     name="user_id",
         *     in="path",
         *     description="用户ID",
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
         * @param int $role_id 角色ID
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
         * 用户独立授权
         * @SWG\Post(
         *   path="/workstation/user/grant/{user_id}",
         *   tags={"表单提交", "创建数据请求"},
         *   summary="用户独立授权",
         *   description="用户独立授权",
         *   @SWG\Parameter(
         *     name="user_id",
         *     in="path",
         *     description="用户ID",
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
         * @param int $role_id 角色ID
         *
         * @return array
         */
        public function grant(int $role_id)
        {
            $permission      = $this->_httpRequest->get('permission', '');
            $permission_list = explode(',', $permission);
            $result          = $this->_selfBusiness->grant($role_id, $permission_list);

            return $result;
        }

        /**
         * @SWG\Get(
         *   path="/workstation/user/get-tree",
         *   tags={"表单提交", "获取数据请求"},
         *   summary="获取用户树列表",
         *   description="输出树形结构的部门列表，并且每个部门数据若包含用户，则会有键值为'_userList'的用户列表数据",
         *   @SWG\Parameter(
         *     name="keyword",
         *     in="query",
         *     description="关键字",
         *     required=false,
         *     type="string"
         *   ),
         *   @SWG\Response(
         *     response="default",
         *     description="返回部门树",
         *   )
         * )
         * @return array
         */
        public function getTreeList()
        {
            $keyword             = $this->_httpRequest->get('keyword', '');
            $result              = $this->_selfBusiness->getTreeList($keyword);

            return $result;
        }
    }