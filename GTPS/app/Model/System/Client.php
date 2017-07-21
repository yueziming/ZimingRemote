<?php
    /**
     * Created by PhpStorm.
     * User: 0967
     * Date: 2017-7-14
     * Time: 17:47
     */

    namespace App\Model\System;

    use App\Standard\Model\JoinTableStandard;
    use Illuminate\Database\QueryException;

    class Client extends System implements JoinTableStandard
    {
        protected $table    = 'client';

        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
        }

        /**
         * 获取客户列表
         *
         * @param JoinTableStandard $organization_model
         * @param bool              $available 是否只获取可用的数据
         *
         * @return array
         */
        public function getList(JoinTableStandard $organization_model, bool $available = true)
        {
            if($available){
                $operator = '=';
                $value    = self::STATUS_ENABLED;
            }
            else{
                $operator = '!=';
                $value    = self::STATUS_DELETED;
            }
            $organization_table = $organization_model->getTable();
            $client_table       = $this->getTable();
            try{
                $result = $this->setTable("$client_table as c")->newQuery()->join("$organization_table as o", 'o.id', '=', 'c.organization_id')->where('c.status', $operator, $value)->get([
                    'c.*',
                    'o.name as organization'
                ])->toArray();
            }catch(QueryException $query_exception){
                $result = [];
            }

            return $result;
        }
    }