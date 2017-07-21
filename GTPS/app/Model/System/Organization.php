<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-17
     * Time: 9:29
     */

    namespace App\Model\System;

    use App\Standard\Model\JoinTableStandard;
    use Illuminate\Database\QueryException;

    class Organization extends System implements JoinTableStandard
    {
        protected $table = 'organization';
        /** 无上级会所的父级ID */
        const ROOT_ID = 0;

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }

        /**
         * 获取会所列表
         *
         * @param bool $available 是否只获取可用的数据
         *
         * @return array
         */
        public function getList(bool $available = true)
        {
            if($available){
                $operator = '=';
                $value    = self::STATUS_ENABLED;
            }
            else{
                $operator = '!=';
                $value    = self::STATUS_DELETED;
            }
            try{
                $result = $this->newQuery()->where('status', $operator, $value)->get()->toArray();
            }catch(QueryException $query_exception){
                $result = [];
            }

            return $result;
        }
    }