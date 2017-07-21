<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-6
     * Time: 9:25
     */

    namespace App\Model\System;

    use App\Standard\Model\JoinTableStandard;

    class RolePermission extends System implements JoinTableStandard
    {
        protected $table = 'role_permission';

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }
    }