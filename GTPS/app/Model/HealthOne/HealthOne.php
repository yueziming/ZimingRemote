<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-3
     * Time: 16:46
     */

    namespace App\Model\HealthOne;

    use App\Model\BaseModel;

    class HealthOne extends BaseModel
    {
        protected $connection = 'healthOne';

        public $timestamps = false;

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }
    }