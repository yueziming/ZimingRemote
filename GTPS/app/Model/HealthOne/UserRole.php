<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-5
     * Time: 17:24
     */

    namespace App\Model\HealthOne;

    use App\Standard\Model\JoinTableStandard;

    class UserRole extends HealthOne implements JoinTableStandard
    {
        protected $table      = 'SYS_UserRoles';
        public    $timestamps = false;

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }
    }