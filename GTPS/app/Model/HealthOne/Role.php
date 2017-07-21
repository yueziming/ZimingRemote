<?php

    namespace App\Model\HealthOne;

    use App\Standard\Model\JoinTableStandard;
    use Exception;
    use Illuminate\Database\QueryException;

    class Role extends HealthOne
    {
        // 角色
        protected $table      = 'SYS_Roles';
        public    $timestamps = false;
        const ID                = 'ID';
        const EMPTY_GROUP_VALUE = '';
        const GROUP_NAME        = 'GroupName';

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }

        /**
         * 获取角色
         *
         * @return array
         */
        public function getList()
        {
            try{
                $list = $this->newQuery()->get()->toArray();
            }catch(QueryException $query_exception){
                $list = [];
            }catch(Exception $exception){
                $list = [];
            }

            return $list;
        }

        /**
         * 根据用户获取该用户被分配的角色
         *
         * @param JoinTableStandard $user_role_model
         * @param int      $user_id 用户ID
         *
         * @return array
         */
        public function getListByUser(JoinTableStandard $user_role_model, $user_id)
        {
            $role_table      = $this->getTable();
            $user_role_table = $user_role_model->getTable();
            try{
                $list = $this->newQuery()->join($user_role_table, "$role_table.ID", "$user_role_table.RoleID")->where("$user_role_table.UserID", '=', $user_id)->select("$role_table.*")->get()->toArray();
            }catch(QueryException $query_exception){
                $list = [];
            }catch(Exception $query_exception){
                $list = [];
            }

            return $list;
        }
    }
