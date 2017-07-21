<?php

    namespace App\Model\HealthOne;

    use App\Standard\Model\JoinTableStandard;
    use Exception;
    use Illuminate\Database\QueryException;

    class User extends HealthOne implements JoinTableStandard
    {
        //坐标 用户信息表
        protected $table      = 'SYS_Users';
        public    $timestamps = false;

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }

        /**
         * 根据角色获取被分配该角色的用户
         *
         * @param JoinTableStandard $user_role_model
         * @param int      $role_id 角色ID
         *
         * @return array
         */
        public function getListByRole(JoinTableStandard $user_role_model, $role_id)
        {
            $user_table      = $this->getTable();
            $user_role_table = $user_role_model->getTable();
            try{
                $list = $this->newQuery()->join($user_role_table, "$user_table.ID", "$user_role_table.UserID")->where("$user_role_table.RoleID", '=', $role_id)->select("$user_table.*")->get()->toArray();
            }catch(QueryException $query_exception){
                $list = [];
            }catch(Exception $query_exception){
                $list = [];
            }

            return $list;
        }
    }
