<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-19
     * Time: 14:13
     */

    namespace App\Model\HealthOne\View;

    class GuangZhouEmployee extends View
    {
        protected $table      = 'GZ_Employee';
        public    $timestamps = false;

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }
    }