<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-5
     * Time: 15:31
     */

    namespace App\Business;

    use App\Data\Cache;
    use App\Data\Time;
    use App\Model\HealthOne\Role;
    use App\Model\HealthOne\UserRole;
    use App\Model\System\Permission;
    use App\Model\System\RolePermission;
    use Illuminate\Database\QueryException;
    use Illuminate\Support\Facades\DB;

    class RoleBusiness extends Business
    {
        private $_roleModel       = null;
        private $_permissionModel = null;

        public function __construct()
        {
            parent::__construct();
            $this->_roleModel       = new Role();
            $this->_permissionModel = new Permission();
        }

        public function getListWithGroup()
        {
            $list          = Cache::pick('Role.Data.List', function (){
                try{
                    return $this->_roleModel->getList();
                }catch(QueryException $query_exception){
                    return [];
                }
            });
            $reflect_table = [];
            $role_list     = [];
            foreach($list as $value){
                if($value[$this->_roleModel::GROUP_NAME] == $this->_roleModel::EMPTY_GROUP_VALUE) $group_name = '【未分组】';
                else $group_name = $value[$this->_roleModel::GROUP_NAME];
                if(!isset($reflect_table[$group_name])){
                    $reflect_table[$group_name] = count($role_list);
                    $role_list[]                = ['name' => $value[$this->_roleModel::GROUP_NAME], 'list' => []];
                }
            }
            foreach($list as $value){
                if($value[$this->_roleModel::GROUP_NAME] == $this->_roleModel::EMPTY_GROUP_VALUE) $group_name = '【未分组】';
                else $group_name = $value[$this->_roleModel::GROUP_NAME];
                $role_list_index                       = $reflect_table[$group_name];
                $role_list[$role_list_index]['list'][] = $value;
            }

            return $role_list;
        }

        public function getListByUser($user_id)
        {
            $list = $this->_roleModel->getListByUser(new UserRole(), $user_id);

            return $list;
        }

        public function getPermission($role_id)
        {
            $assigned_permission      = $this->_permissionModel->getListByRole(new RolePermission(), $role_id);
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
         * 为角色授权
         *
         * @param int   $role_id    角色ID
         * @param array $permission 权限列表
         *
         * @return array
         */
        public function grant(int $role_id, array $permission)
        {
            $role_permission_model = new RolePermission();
            $data                  = [];
            foreach($permission as $value) $data[] = [
                'role_id'       => $role_id,
                'permission_id' => $value,
                'grant_time'    => Time::getCurrentTime(),
                'status'        => $role_permission_model::STATUS_ENABLED,
                'creatime'      => Time::getCurrentTime()
            ];
            try{
                $result = DB::transaction(function () use ($data, $role_permission_model, $role_id, $permission){
                    $result = $role_permission_model->newQuery()->insert($data);

                    return $result ? self::returnResult(true, '授权成功') : self::returnResult(false, '授权失败');
                });
            }catch(QueryException $query_exception){
                $result = self::returnResult(false, $query_exception->getMessage());
            }

            return $result;
        }

        /**
         * 收回角色权限
         *
         * @param int   $role_id    角色ID
         * @param array $permission 权限列表
         *
         * @return array
         */
        public function revoke(int $role_id, array $permission)
        {
            $role_permission_model = new RolePermission();
            try{
                $result = DB::transaction(function () use ($role_permission_model, $role_id, $permission){
                    $result = $role_permission_model->newQuery()->where([
                        ['status', '=', $role_permission_model::STATUS_ENABLED],
                        ['role_id', '=', $role_id]
                    ])->whereIn('permission_id', $permission)->update([
                        'status'      => $role_permission_model::STATUS_DISABLED,
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
    }