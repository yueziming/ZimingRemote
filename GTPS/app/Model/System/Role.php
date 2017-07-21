<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-6-23
     * Time: 11:18
     */

    namespace App\Model\System;

    class Role extends System
    {
        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }

        /**
         * 为角色授权
         *
         * @param int       $role_id    角色ID
         * @param int|array $permission 权限
         */
        public function grant($role_id, $permission)
        {
            if(is_array($permission)){
                foreach($permission as $item){
                    // todo
                }
            }
            elseif(is_numeric($permission)){
                // todo
            }
            else{

            }
        }
    }