<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-6
     * Time: 9:28
     */

    namespace App\Model\System;

    use App\Standard\Model\JoinTableStandard;

    class UserPermission extends System implements JoinTableStandard
    {
        protected $table = 'user_permission';

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }
    }