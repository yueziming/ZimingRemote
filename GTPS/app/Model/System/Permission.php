<?php

    namespace App\Model\System;

    use App\Data\Time;
    use App\Model\BaseModel;
    use App\Standard\Model\JoinTableStandard;
    use Exception;
    use Illuminate\Database\QueryException;
    use Illuminate\Support\Facades\DB;

    class Permission extends System
    {
        /** 父级ID的最高层级 */
        const PARENT_ROOT_ID = 0;
        /** 自身ID */
        const ID = 'id';
        /** 父级ID */
        const PARENT_ID = 'parent_id';
        protected $table = 'permission';

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }

        /**
         * 获取权限列表
         *
         * @return array
         */
        public function getList()
        {
            try{
                $all_permission = $this->newQuery()->get()->toArray();
            }catch(QueryException $query_exception){
                $all_permission = [];
            }

            return $all_permission;
        }

        /**
         * 根据角色获取该角色被授予的权限
         *
         * @param JoinTableStandard $role_permission_model
         * @param int|array(int)    $role_id 角色ID
         *
         * @return array
         */
        public function getListByRole(JoinTableStandard $role_permission_model, $role_id)
        {
            $permission_table      = $this->getTable();
            $role_permission_table = $role_permission_model->getTable();
            if(!is_array($role_id)) $role_id = [(int)$role_id];
            try{
                $list = $this->newQuery()->join($role_permission_table, "$role_permission_table.permission_id", "$permission_table.id")->where([
                    [
                        "$role_permission_table.status",
                        '=',
                        BaseModel::STATUS_ENABLED
                    ]
                ])->whereIn("$role_permission_table.role_id", $role_id)->select("$permission_table.*")->get()->toArray();
            }catch(QueryException $query_exception){
                $list = [];
            }catch(Exception $query_exception){
                $list = [];
            }

            return $list;
        }

        /**
         * 根据用户获取该用户被授予的独立权限
         *
         * @param JoinTableStandard $user_permission_model
         * @param int               $user_id 用户ID
         *
         * @return array
         */
        public function getListByUser(JoinTableStandard $user_permission_model, $user_id)
        {
            $permission_table      = $this->getTable();
            $user_permission_table = $user_permission_model->getTable();
            try{
                $list = $this->newQuery()->join($user_permission_table, "$user_permission_table.permission_id", "$permission_table.id")->where([
                    [
                        "$user_permission_table.status",
                        '=',
                        BaseModel::STATUS_ENABLED
                    ],
                    [
                        "$user_permission_table.user_id",
                        '=',
                        $user_id
                    ]
                ])->select("$permission_table.*")->get()->toArray();
            }catch(QueryException $query_exception){
                $list = [];
            }catch(Exception $exception){
                $list = [];
            }

            return $list;
        }

//        private function _getPermissionList(array $permission)
//        {
//            /** @var \Quasar\Utility\Tree $tree_object */
//            $tree_object = app('Quasar.Tree');
//            $all_permission = $this::get()->toArray();
//            $tree_object->setData($all_permission);
//            $tree_object->parseTree();
//            $result = [];
//            foreach($permission as $value){
//                $child_permission   = $tree_object->getChildList($value);
//                $child_permission[] = $value;
//                $result             = array_merge($result, $child_permission);
//            }
//            $result = array_unique($result);
//
//            return $result;
//        }

    }
