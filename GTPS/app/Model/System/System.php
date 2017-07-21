<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-6-23
     * Time: 11:19
     */

    namespace App\Model\System;

    use App\Model\BaseModel;

    class System extends BaseModel
    {
        protected $connection = 'self';

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }
    }