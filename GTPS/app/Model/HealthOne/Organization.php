<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-13
     * Time: 14:59
     */

    namespace App\Model\HealthOne;

    use App\Standard\Model\JoinTableStandard;

    class Organization extends HealthOne implements JoinTableStandard
    {
        protected $table      = 'SCA1';
        public    $timestamps = false;

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }

        public function getList()
        {
            $list = $this->newQuery()->where('SCA56', '=', 1)->get()->toArray();

            return $list;
        }
    }