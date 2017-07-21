<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-6-24
     * Time: 16:59
     */

    namespace App\Business;

    use App\Data\Cache;
    use App\Data\Session;
    use App\Data\Time;
    use App\Model\HealthOne\Department;
    use App\Model\HealthOne\Employee;
    use App\Model\HealthOne\Role;
    use App\Model\HealthOne\User;
    use App\Model\HealthOne\UserRole;
    use App\Model\System\Permission;
    use App\Model\System\RolePermission;
    use App\Model\System\UserPermission;
    use ErrorException;
    use Exception;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;

    class UserBusiness extends Business
    {
        /** @var Request|null */
        private $_httpRequest   = null;
        private $_userModel       = null;
        private $_roleModel       = null;
        private $_permissionModel = null;

        public function __construct(Request $request)
        {
            parent::__construct();
            $this->_permissionModel = new Permission();
            $this->_userModel       = new User();
            $this->_roleModel       = new Role();
            $this->_httpRequest   = $request;
        }

        /**
         * 将用户信息写入Session
         *
         * @param array $user_info 用户信息
         *
         * @return array
         */
        public function saveSession(array $user_info)
        {
            if(!isset($user_info['id']) || !isset($user_info['code']) || !isset($user_info['name'])) return self::returnResult(false, '信息写入异常');
            (function () use ($user_info){
                $this->_httpRequest->session()->put(Session::LOGIN_USER_ID, $user_info['id']);
                $this->_httpRequest->session()->put(Session::LOGIN_USER_CODE, $user_info['code']);
                $this->_httpRequest->session()->put(Session::LOGIN_USER_NAME, $user_info['name']);
                $this->_httpRequest->session()->save();
            })();
            (function () use ($user_info){
                $login_user_list = Cache::get('Login.User.List');
                $session_id      = $this->_httpRequest->session()->getId();
                if(!(isset($login_user_list[$user_info['id']]) && count($login_user_list[$user_info['id']])>0)) $login_user_list[$user_info['id']] = [];
                $login_user_list[$user_info['id']][$session_id] = [
                    'userAgent' => $this->_httpRequest->headers->get('user-agent'),
                    'sessionID' => $session_id,
                    'userID'    => $user_info['id'],
                    'userCode'  => $user_info['code'],
                    'userName'  => $user_info['name'],
                ];
                Cache::set('Login.User.List', $login_user_list, Cache::INFINITE_TIME);
            })();

            return self::returnResult(true, '操作成功');
        }

        /**
         * 清除Session数据
         */
        public function cleanSession()
        {
            (function (){
                $login_user_list = Cache::get('Login.User.List');
                $user_id         = $this->_httpRequest->session()->get(Session::LOGIN_USER_ID);
                $session_id      = $this->_httpRequest->session()->getId();
                if(isset($login_user_list[$user_id][$session_id])){
                    unset($login_user_list[$user_id][$session_id]);
                    if(count($login_user_list[$user_id]) === 0) unset($login_user_list[$user_id]);
                    Cache::set('Login.User.List', $login_user_list, Cache::INFINITE_TIME);
                }
            })();
            (function (){
                foreach($this->_httpRequest->session()->all() as $key => $session){
                    if(preg_match('/^SESSION_\S+$/', $key)) $this->_httpRequest->session()->remove($key);
                }
            })();
        }

        /**
         * 获取角色下的用户
         *
         * @param int $role_id 角色ID
         *
         * @return array
         */
        public function getListByRole(int $role_id)
        {
            $list = $this->_userModel->getListByRole(new UserRole(), $role_id);

            return $list;
        }

        /**
         * 获取用户的独立授权权限
         *
         * @param int $user_id 用户ID
         *
         * @return array
         */
        public function getPermission(int $user_id)
        {
            $assigned_permission      = $this->_permissionModel->getListByUser(new UserPermission(), $user_id);
            $all_permission           = $this->_permissionModel->getList();
            $assigned_permission_list = [];
            foreach($assigned_permission as $permission) $assigned_permission_list[] = $permission[$this->_permissionModel::ID];
            foreach($all_permission as &$permission){
                if(in_array($permission[$this->_permissionModel::ID], $assigned_permission_list)) $permission['granted'] = true;
                else $permission['granted'] = false;
            }
            unset($permission);
            /** @var \Illuminate\Foundation\Application|\Quasar\Utility\Tree $tree_object */
            $tree_object = app('Quasar.Tree');
            $tree_object->setData($all_permission);
            $result = $tree_object->parseTree();

            return $result;
        }

        /**
         * 获取用户所有的权限列表
         *
         * @param int $user_id 用户ID
         *
         * @return array
         */
        public function getAllPermission(int $user_id)
        {
            $role_list            = (function () use ($user_id){
                $role_list    = [];
                $role_of_user = $this->_roleModel->getListByUser(new UserRole(), $user_id);
                foreach($role_of_user as $role) $role_list[] = $role[$this->_roleModel::ID];

                return $role_list;
            })();
            $role_permission_list = (function ($role_list){
                $assigned_role_permission = $this->_permissionModel->getListByRole(new RolePermission(), $role_list);
                $role_permission_list     = [];
                foreach($assigned_role_permission as $permission) $role_permission_list[] = $permission[$this->_permissionModel::ID];

                return $role_permission_list;
            })($role_list);
            $user_permission_list = (function () use ($user_id){
                $assigned_user_permission = $this->_permissionModel->getListByUser(new UserPermission(), $user_id);
                $user_permission_list     = [];
                foreach($assigned_user_permission as $permission) $user_permission_list[] = $permission[$this->_permissionModel::ID];

                return $user_permission_list;
            })();
            $result               = (function ($role_permission_list, $user_permission_list){
                $all_permission = $this->_permissionModel->getList();
                foreach($all_permission as &$permission){
                    if(in_array($permission[$this->_permissionModel::ID], $user_permission_list)) $permission['userGranted'] = true;
                    else $permission['userGranted'] = false;
                    if(in_array($permission[$this->_permissionModel::ID], $role_permission_list)) $permission['roleGranted'] = true;
                    else $permission['roleGranted'] = false;
                }

                return $all_permission;
            })($role_permission_list, $user_permission_list);
            /** @var \Illuminate\Foundation\Application|\Quasar\Utility\Tree $tree_object */
            $tree_object = app('Quasar.Tree');
            $tree_object->setData($result);
            $result = $tree_object->parseTree();

            return $result;
        }

        /**
         * 为用户授权
         *
         * @param int   $user_id    用户ID
         * @param array $permission 权限列表
         *
         * @return array
         */
        public function grant(int $user_id, array $permission)
        {
            $user_permission_model = new UserPermission();
            $data                  = [];
            foreach($permission as $value) $data[] = [
                'user_id'       => $user_id,
                'permission_id' => $value,
                'grant_time'    => Time::getCurrentTime(),
                'status'        => $user_permission_model::STATUS_ENABLED,
                'creatime'      => Time::getCurrentTime()
            ];
            try{
                $result = DB::transaction(function () use ($data, $user_permission_model, $user_id, $permission){
                    $result = $user_permission_model->newQuery()->insert($data);

                    return $result ? self::returnResult(true, '授权成功') : self::returnResult(false, '授权失败');
                });
            }catch(QueryException $query_exception){
                $result = self::returnResult(false, $query_exception->getMessage());
            }

            return $result;
        }

        /**
         * 收回用户权限
         *
         * @param int   $user_id    用户ID
         * @param array $permission 权限列表
         *
         * @return array
         */
        public function revoke(int $user_id, array $permission)
        {
            $user_permission_model = new UserPermission();
            try{
                $result = DB::transaction(function () use ($user_permission_model, $user_id, $permission){
                    $result = $user_permission_model->newQuery()->where([
                        ['status', '=', $user_permission_model::STATUS_ENABLED],
                        ['user_id', '=', $user_id]
                    ])->whereIn('permission_id', $permission)->update([
                        'status'      => $user_permission_model::STATUS_DISABLED,
                        'revoke_time' => Time::getCurrentTime(),
                        'updatime'    => Time::getCurrentTime()
                    ]);

                    return $result ? self::returnResult(true, '收回权限成功') : self::returnResult(false, '收回权限失败');
                });
            }catch(QueryException $query_exception){
                $result = self::returnResult(false, $query_exception->getMessage());
            }

            return $result;
        }

        /**
         * 获取用户列表，并以部门所属的形式树形输出
         *
         * @param string $keyword 关键字
         *
         * @return array|mixed
         */
        public function getTreeList(string $keyword)
        {
            /** @var \Illuminate\Foundation\Application|\Quasar\Utility\Tree $tree_object */
            $tree_object = app('Quasar.Tree');
            $tree_object->setConfig([
                'parentIndex' => Department::PARENT_ID,
                'selfIndex'   => Department::ID
            ]);
            $correlate = function ($employee_list, $department_list){
                // 构建部门ID和数据列表数字索引的映射表
                $reflect_table = [];
                foreach($department_list as $key => $department) $reflect_table[$department[Department::ID]] = $key;
                unset($key);
                foreach($employee_list as $key => $user){
                    try{
                        $department_list_index = $reflect_table[$user[Department::ID]];
                    }catch(ErrorException $error_exception){
                        $department_list_index = null;
                    }
                    if($department_list_index !== null){
                        if(!isset($department_list[$department_list_index]['_userList'])) $department_list[$department_list_index]['_userList'] = [];
                        $department_list[$department_list_index]['_userList'][] = $user;
                    }
                }

                return $department_list;
            };
            // 获取员工列表
            $employee_list = (function ($keyword){
                if($keyword !== '' && $keyword !== null) $redis_key = "Employee.Data.List.$keyword";
                else $redis_key = 'Employee.Data.List';
                $result = Cache::pick($redis_key, function () use ($keyword){
                    try{
                        return (new Employee())->getList($this->_userModel, $keyword);
                    }catch(Exception $exception){
                        return [];
                    }
                });

                return $result;
            })($keyword);
            if($keyword !== '' && $keyword !== null) return $employee_list;
            // 获取部门列表
            $department_list = Cache::pick('Department.Data.List', function (){
                try{
                    return (new Department())->newQuery()->where('bck16', '>', Time::getCurrentTime())->get()->toArray();
                }catch(QueryException $query_exception){
                    return [];
                }
            });
            // 关联
            $department_list = $correlate($employee_list, $department_list);
            // 树形输出
            $tree_object->setData($department_list);
            $result = $tree_object->parseTree();

            return $result;
        }
    }